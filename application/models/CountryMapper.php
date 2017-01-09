<?php
/**
 * Created by PhpStorm.
 * User: shashikant.kuswaha
 * Date: 1/9/2017
 * Time: 4:40 PM
 */
class Application_Model_CountryMapper
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
            $this->setDbTable('Application_Model_DbTable_Country');
        }
        return $this->_dbTable;
    }


    public function find($id, Application_Model_Country $countrydata)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $countrydata->setId($row->id)
            ->setCountry($row->country);

    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $countries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Country();
            $entry->setId($row->id)
                ->setCountry($row->country);

            $countries[] = $entry;
        }
        return $countries;
    }
}