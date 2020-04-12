<?php
namespace Model;

class FilmModel extends \Core\Entity
{
    protected $_relations = ['has one' => 'genre'];

    public function edit($params)
    {
        $this->_allValues = $params;
        return $this->update($this->id);
    }
}