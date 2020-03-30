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

    public static function read($table, $id)
    {
        $req = Database::getDbConnection()->prepare('SELECT * FROM '.$table.' WHERE id = :id ;');
        if($req->execute(['id' => $id]) == true) {
            return $req->fetch(\PDO::FETCH_ASSOC);
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

    public static function find($table, $params = [])
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