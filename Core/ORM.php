<?php
namespace Core;

class ORM
{
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
                return false;
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

    public static function read($table, $id, $relations)
    {
        $req = Database::getDbConnection()->prepare('SELECT * FROM '.$table.' WHERE id = :id ;');
        if($req->execute(['id' => $id]) == true) {
            $toReturn = $req->fetch(\PDO::FETCH_ASSOC);

            # relations part

            foreach($relations as $type => $tableJoin) {
                if ($type == 'has many') {
                    $st = Database::getDbConnection()->prepare('SELECT '.$tableJoin.'.* FROM ' . $tableJoin . ' INNER JOIN ' . $table . ' ON '. $tableJoin .'.'.$table.'_id='.$table.'.id WHERE '.$table.'.id='.$toReturn['id'].';');
                    if($st->execute() == true) {
                        $joinRelations = [];
                        while($data = $st->fetch(\PDO::FETCH_ASSOC)) {
                            $joinRelations[$tableJoin.'-'.$data['id']] = $data;
                        }
                        $toReturn[$tableJoin] = $joinRelations;
                    }
                } elseif ($type == 'has one') {
                    $st = Database::getDbConnection()->prepare('SELECT '.$tableJoin.'.* FROM ' . $tableJoin . ' INNER JOIN ' . $table . ' ON '. $table .'.'.$tableJoin.'_id='.$tableJoin.'.id WHERE '.$table.'.id='.$toReturn['id'].';');
                    if($st->execute() == true) {
                        $data = $st->fetch(\PDO::FETCH_ASSOC);
                        $toReturn[$tableJoin.'-'.$data['id']] = $data;
                    }
                }
            }

            # end relations part
            return $toReturn;
        } else {
            return false;
        }

    }

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
        $req = Database::getDbConnection()->prepare('UPDATE '.$table.' SET '.implode(', ', $this->readyToUse($toFill)).' WHERE id = '.$id.';');
        return $req->execute($values);
    }

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

    public static function find($table, $params = [], $relations)
    {
        $toReturn = [];
        $req = Database::getDbConnection()->prepare('SELECT * FROM ' . $table . ' ' . implode(' ', $this->readyToUse($params, 2)) .' ;');
        if($req->execute([]) == true){
            while($data = $req->fetch(\PDO::FETCH_ASSOC)) {
                $toReturn['id-'.$data['id']] = $data;
            }
            return $toReturn;
        } else {
            return false;
        }
    }

    private function readyToUse($arr, $type = 1)
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