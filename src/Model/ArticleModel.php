<?php
namespace Model ;

class ArticleModel extends \Core\Entity
{
    public function save()
    {
        \Core\ORM::create($this->_table, $this->_allValues);
    }
}