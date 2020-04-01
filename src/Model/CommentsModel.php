<?php
namespace Model ;

class CommentsModel extends \Core\Entity
{
    public function save()
    {
        \Core\ORM::create($this->_table, $this->_allValues);
    }
}