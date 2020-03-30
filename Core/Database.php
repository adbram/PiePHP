<?php
namespace Core;
use \PDO;

class Database
{
    private static $_db;

    public static function connectDatabase($host, $dbname, $login, $password)
    {
        self::$_db = new  PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $login, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    public static function getDbConnection()
    {
        return self::$_db;
    }
}