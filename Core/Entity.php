<?php
namespace Core;

class Entity
{
    protected $_table;
    protected $_allValues;
    protected $_relations = [];

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
        unset($this->_allValues['_relations']);
        if(isset($this->id)){
            $relations = ORM::relations($this->_table, $this->_relations, $this->id);
            foreach($relations as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    protected function createAttribute($params)
    {
        foreach($params as $key => $value) {
            $this->$key = $value;
        }
    }

    public function create()
    {
        return ORM::create($this->_table, $this->_allValues);
    }

    public function read($id)
    {
        return ORM::read($this->_table, $id);
    }

    public function update($id)
    {
        return ORM::update($this->_table, $id, $this->_allValues);
    }

    public function delete($id)
    {
        return ORM::delete($this->_table, $id);
    }

    public function find($params = [])
    {
        return ORM::find($this->_table, $params);
    }
}