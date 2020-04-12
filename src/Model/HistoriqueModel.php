<?php
namespace Model;

class HistoriqueModel extends \Core\Entity
{
    protected $_relations = ['has one' => 'film'];
}