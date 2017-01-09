<?php
/**
 * Created by PhpStorm.
 * User: shashikant.kuswaha
 * Date: 1/9/2017
 * Time: 4:40 PM
 */
class Application_Model_StateMapper
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
            $this->setDbTable('Application_Model_DbTable_State');
        }
        return $this->_dbTable;
    }

    public function find($id, Application_Model_State $statedata)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $statedata->setId($row->id)
            ->setState($row->state)
            ->setCountryId($row->countryId);

    }

    public function fetchAll($countryId)
    {
        $resultSet = $this->getDbTable()->fetchAll($this->getDbTable()->select()->where('country_id=?',$countryId));
        $states   = array();
        foreach($resultSet as $row) {
            $statedata = new Application_Model_State();
            $statedata->setId($row->id)
                ->setState($row->state)
                ->setCountryId($row->country_id);

            $states[]=$statedata;
        }
        return $states;
    }

}