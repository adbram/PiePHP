<?php
namespace Core;

/**
 * ORM sera le pont qui vous reliera a votre bdd
 */
class ORM
{
    /**
     * create cree une entree dans la table donnee en parametre, avec les donnees recus en paramtre egalement
     *
     * @param  mixed $table
     * @param  mixed $fields pour chaque element, l'index doit correspondre au nom de la colonne dans la table
     * @return false si on donne des mauvaise donnees
     * @return string l'id de l'entree quand la requete reussi
     */
    public static function create($table, $fields = [])
    {
        $toFill = array_keys($fields);
        $values = array_values($fields);
        $availablesFields = [];

        $reqFields = Database::getDbConnection()->query('DESCRIBE '.$table.';');
        while($data = $reqFields->fetch(\PDO::FETCH_ASSOC)) {
            $availablesFields[] = $data['Field'];
        }
        foreach($toFill as $field){
            if(!in_array($field, $availablesFields)) {
                return $field;
            }
        }
        $interrogationPoints = array_fill(0, count($values), '?');
        $req = Database::getDbConnection()->prepare('INSERT INTO '.$table.' ('.implode(', ', $toFill).') VALUES ('.implode(', ', $interrogationPoints).');');
        if($req->execute($values) == true) {
            $st = Database::getDbConnection()->query('SELECT * FROM '.$table.' ORDER BY id DESC LIMIT 1;');
            return $st->fetch(\PDO::FETCH_ASSOC)['id'];
        } else {
            return false;
        }
    }

    /**
     * read cherche une entree avec un id
     *
     * @param  mixed $table
     * @param  mixed $id
     * @return false si rien n'est trouve
     * @return array correspondant a l'entree trouvee
     */
    public static function read($table, $id)
    {
        $req = Database::getDbConnection()->prepare('SELECT * FROM '.$table.' WHERE id = :id ;');
        if($req->execute(['id' => $id]) == true) {
            $class = '\Model\\' . ucfirst($table) . 'Model';
            $toReturn =  new $class($req->fetch(\PDO::FETCH_ASSOC));
            if(!empty($toReturn)) {
                return $toReturn;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * update modidfie une entree, qu'on cible avec un id
     *
     * @param  mixed $table
     * @param  mixed $id
     * @param  mixed $fields
     * @return true si requete reussie
     * @return false si requete echouee
     */
    public static function update($table, $id, $fields)
    {
        $toFill = array_keys($fields);
        $values = array_values($fields);
        $availablesFields = [];

        $reqFields = Database::getDbConnection()->query('DESCRIBE '.$table.';');
        while($data = $reqFields->fetch(\PDO::FETCH_ASSOC)) {
            $availablesFields[] = $data['Field'];
        }
        foreach($toFill as $field){
            if(!in_array($field, $availablesFields)) {
                return false;
            }
        }
        $interrogationPoints = array_fill(0, count($values), '?');
        $req = Database::getDbConnection()->prepare('UPDATE '.$table.' SET '.implode(', ', self::readyToUse($toFill)).' WHERE id = '.$id.';');
        return $req->execute($values);
    }

    /**
     * delete supprime une entree, qu'on cible avec un id
     *
     * @param  mixed $table
     * @param  mixed $id
     * @return true si requete reussie
     * @return false si requete echouee
     */
    public static function delete($table, $id)
    {
        $req = Database::getDbConnection()->prepare('DELETE FROM '.$table.' WHERE id = :id ;');
        $req->execute(['id' => $id]);
        if($req->rowCount() != 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * find cherche toutes les entrees correspondants aux parametres donnes dans "params"
     *
     * @param  mixed $table
     * @param  mixed $params en index on donne la regle SQL et en valeur sa valeur, expl: ['WHERE' => 'id = 1']
     * @return array avec toutes les entrees correspondantes et leurs valeurs
     * @return false si rien n'est trouve
     */
    public static function find($table, $params = [])
    {
        $toReturn = [];
        $req = Database::getDbConnection()->prepare('SELECT * FROM ' . $table . ' ' . implode(' ', self::readyToUse($params, 2)) .' ;');
        if($req->execute([]) == true){
            while($data = $req->fetch(\PDO::FETCH_ASSOC)) {
                $class = '\Model\\' . ucfirst($table) . 'Model';
                $toReturn[] =  new $class($data);
            }
            if(!empty($toReturn)) {
                return $toReturn;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function relations($table, $relations, $id)
    {
        $callInfo = debug_backtrace()[2];
        $callFileFullPath = explode('\\', $callInfo['file']);
        $callFile = array_pop($callFileFullPath);
        if($callFile != 'Entity.php'){
            $toReturn = [];
            foreach($relations as $type => $tableJoin) {
                if ($type == 'has many') {
                    $st = Database::getDbConnection()->prepare('SELECT '.$tableJoin.'.* FROM ' . $tableJoin . ' INNER JOIN ' . $table . ' ON '. $tableJoin .'.'.$table.'_id='.$table.'.id WHERE '.$table.'.id='.$id.';');
                    if($st->execute() == true) {
                        $joinRelations = [];
                        while($data = $st->fetch(\PDO::FETCH_ASSOC)) {
                            $class = '\Model\\' . ucfirst($tableJoin) . 'Model';
                            $joinRelations[] = new $class($data);
                        }
                        $toReturn[$tableJoin] = $joinRelations;
                    }
                } elseif ($type == 'has one') {
                    $st = Database::getDbConnection()->prepare('SELECT '.$tableJoin.'.* FROM ' . $tableJoin . ' INNER JOIN ' . $table . ' ON '. $table .'.'.$tableJoin.'_id='.$tableJoin.'.id WHERE '.$table.'.id='.$id.';');
                    if($st->execute() == true) {
                        $data = $st->fetch(\PDO::FETCH_ASSOC);
                        $class = '\Model\\' . ucfirst($tableJoin) . 'Model';
                        $toReturn[$tableJoin] = new $class($data);
                    }
                }
            }
            return $toReturn;
        } else {
            return [];
        }
    }

    private static function readyToUse($arr, $type = 1)
    {
        if($type == 1) {
            foreach($arr as $key => $value) {
                $arr[$key] = $value . ' = ?';
            }
            return $arr;
        } elseif ($type = 2) {
            foreach($arr as $key => $value) {
                $arr[$key] = $key . ' ' . $value;
            }
            return $arr;
        }
    }
}