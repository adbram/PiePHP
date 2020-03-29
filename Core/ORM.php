<?php
namespace Core;
use \PDO;

class ORM
{
    private static $_db;

    public function __construct()
    {
        self::$_db = new  PDO('mysql:host=127.0.0.1;dbname=piephp;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    public function create($table, $fields = []) // sans verifications d'email pour l'instant psk je sais pas comment le projet va evoluer
    {
        $toFill = array_keys($fields);
        $values = array_values($fields);
        $availablesFields = [];

        $reqFields = self::$_db->query('DESCRIBE '.$table.';');
        while($data = $reqFields->fetch(PDO::FETCH_ASSOC)) {
            $availablesFields[] = $data['Field'];
        }
        foreach($toFill as $field){
            if(!in_array($field, $availablesFields)) {
                return false;
            }
        }
        $interrogationPoints = array_fill(0, count($values), '?');
        $req = self::$_db->prepare('INSERT INTO '.$table.' ('.implode(', ', $toFill).') VALUES ('.implode(', ', $interrogationPoints).');');
        if($req->execute($values) == true) {
            $st = self::$_db->query('SELECT * FROM '.$table.' ORDER BY id DESC LIMIT 1;');
            return $st->fetch(PDO::FETCH_ASSOC)['id'];
        } else {
            return false;
        }
    }

    public function read($table, $id)
    {
        $req = self::$_db->prepare('SELECT * FROM '.$table.' WHERE id = :id ;');
        if($req->execute(['id' => $id]) == true) {
            return $req->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function update($table, $id, $fields)
    {
        // $req = self::$_db->prepare('UPDATE users SET email = :email, password = :password;');
        // $req->execute(['email' => $this->getEmail(), 'password' => $this->getPassword()]);

        $toFill = array_keys($fields);
        $values = array_values($fields);
        $availablesFields = [];

        $reqFields = self::$_db->query('DESCRIBE '.$table.';');
        while($data = $reqFields->fetch(PDO::FETCH_ASSOC)) {
            $availablesFields[] = $data['Field'];
        }
        foreach($toFill as $field){
            if(!in_array($field, $availablesFields)) {
                return false;
            }
        }
        $interrogationPoints = array_fill(0, count($values), '?');
        $req = self::$_db->prepare('UPDATE '.$table.' SET '.implode(', ', $this->readyToUse($toFill)).' WHERE id = '.$id.';');
        return $req->execute($values);
    }

    public function delete($table, $id)
    {
        $req = self::$_db->prepare('DELETE FROM '.$table.' WHERE id = :id ;');
        $req->execute(['id' => $id]);
        if($req->rowCount() != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function find($table, $params = [])
    {
        $toReturn = [];
        $req = self::$_db->prepare('SELECT * FROM ' . $table . ' ' . implode(' ', $this->readyToUse($params, 2)) .' ;');
        if($req->execute([]) == true){
            while($data = $req->fetch(PDO::FETCH_ASSOC)) {
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