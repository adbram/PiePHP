<?php
namespace Core;

abstract class Entity
{
    protected $_table;
    protected $_allValues;

    public function __construct($params)
    {
        $this->_table = str_replace('model', '', stripslashes(strtolower(get_class($this))));
        if(array_key_exists('id', $params) && count($params) == 1) {
            $this->createAttribute(ORM::read($this->_table, $params['id']));
        } else {
            $this->createAttribute($params);
        }
        $this->_allValues = get_object_vars($this);
        unset($this->_allValues['_table']);
        unset($this->_allValues['_allValues']);
    }

    private function createAttribute($params)
    {
        foreach($params as $key => $value) {
            $this->$key = $value;
        }
    }
}