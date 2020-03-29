<?php
namespace Core;

class Entity
{
    public function __construct($params)
    {
        $this->createAttribute($params);
    }

    private function createAttribute($params){
        foreach($params as $key => $value) {
            $this->$key = $value;
        }
    }
}