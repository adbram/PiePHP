<?php
namespace Core;

/**
 * Entity est le squelette de tous vos futurs models
 */
class Entity
{
    protected $_table;
    /**
     * _allValues contiendra toutes les variables, pretes a etre utilisees, lors notamment des "create" et "update"
     *
     * @var mixed
     */
    protected $_allValues;
    /**
     * _relations contiendra les relations du model, qu'on donne a l'instance
     *
     * @var array
     */
    protected $_relations = [];

    /**
     * __construct prepare le model pour les actions a venir, en definissant la table, les donnees du model et tout autre variable necessaire au bon fonctionnement des requetes sql
     *
     * @param  mixed $params
     * @return void
     */
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

    /**
     * createAttribute cree des attributs public a partir de l'array recu en argument, chaque element donnera "naissance" a un attribut avec comme valeur la valeur de ce dernier, et comme nom de la variable l'index de l'element
     *
     * @param  mixed $params
     * @return void
     */
    protected function createAttribute($params)
    {
        foreach($params as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * create appelle la fonction du meme nom dans la classe "ORM", cette alternative est un raccourci a son homonyme se trouvant dans "ORM" qui nous permet de ne pas reecrire les arguments
     *
     * @return void
     */
    public function create()
    {
        return ORM::create($this->_table, $this->_allValues);
    }

    /**
     * read  appelle la fonction du meme nom dans la classe "ORM", cette alternative est un raccourci a son homonyme se trouvant dans "ORM" qui nous permet de ne pas reecrire les arguments
     *
     * @param  mixed $id
     * @return void
     */
    public function read($id)
    {
        return ORM::read($this->_table, $id);
    }

    /**
     * update  appelle la fonction du meme nom dans la classe "ORM", cette alternative est un raccourci a son homonyme se trouvant dans "ORM" qui nous permet de ne pas reecrire les arguments
     *
     * @param  mixed $id
     * @return void
     */
    public function update($id)
    {
        return ORM::update($this->_table, $id, $this->_allValues);
    }

    /**
     * delete appelle la fonction du meme nom dans la classe "ORM", cette alternative est un raccourci a son homonyme se trouvant dans "ORM" qui nous permet de ne pas reecrire les arguments
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        return ORM::delete($this->_table, $id);
    }

    /**
     * find appelle la fonction du meme nom dans la classe "ORM", cette alternative est un raccourci a son homonyme se trouvant dans "ORM" qui nous permet de ne pas reecrire les arguments
     *
     * @param  mixed $params
     * @return void
     */
    public function find($params = [])
    {
        return ORM::find($this->_table, $params);
    }
}