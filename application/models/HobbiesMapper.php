<?php
/**
 * Created by PhpStorm.
 * User: shashikant.kuswaha
 * Date: 1/9/2017
 * Time: 4:40 PM
 */
class Application_Model_HobbiesMapper
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
            $this->setDbTable('Application_Model_DbTable_Hobbies');
        }
        return $this->_dbTable;
    }


    public function find($id, Application_Model_Hobbies $hobbies)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $hobbies->setId($row->id)
            ->setHobbies($row->hobbies);

    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $hobbies   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Hobbies();
            $entry->setId($row->id)
                ->setHobbies($row->hobbies);

            $hobbies[] = $entry;
        }
        return $hobbies;
    }
}