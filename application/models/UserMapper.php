<?php
/**
 * Created by PhpStorm.
 * User: shashikant.kuswaha
 * Date: 1/6/2017
 * Time: 5:07 PM
 */
class Application_Model_UserMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_User');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_UserData $userdata)
    {
        $data = array(
            'email'     => $userdata->getEmail(),
            'name'      => $userdata->getName(),
            'gender'    => $userdata->getGender(),
            'country_id'   => $userdata->getCountry(),
            'state_id'     => $userdata->getState(),
            'hobbies_id'   => $userdata->getHobbies(),
            'image'     => $userdata->getImage()

        );

        if (null === ($id = $userdata->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_UserData $userdata)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $userdata->setId($row->id)
            ->setEmail($row->email)
            ->setName($row->name);

    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();

        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_UserData();
            $entry->setId($row->id)
                ->setEmail($row->email)
                ->setName($row->name)
                ->setGender($row->gender)
                ->setCountry($row->country_id)
                ->setState($row->state_id)
                ->setHobbies($row->hobbies_id)
                ->setImage($row->image);

            $entries[] = $entry;
        }
        return $entries;
    }
}