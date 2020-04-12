<?php
namespace Model;

class GenreModel extends \Core\Entity
{
    protected $_relations = ['has many' => 'film'];
}