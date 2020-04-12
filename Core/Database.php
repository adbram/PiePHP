<?php
namespace Core;
use \PDO;

/**
 * Database pourra etre appeler n'importe ou pour recuperer la connexion a la base de donnee
 */
class Database
{
    private static $_db;

    /**
     * connectDatabase
     *
     * @param  mixed $host
     * @param  mixed $dbname
     * @param  mixed $login
     * @param  mixed $password
     * Parametrez la base de donnees sur laquelle vous travaillez, dans le fichier "src/dbconnection.php"
     * @return void
     */
    public static function connectDatabase($host, $dbname, $login, $password)
    {
        self::$_db = new  PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $login, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    /**
     * getDbConnection
     * Fonction utilisee par la classe "ORM" notamment, lors des requetes sql
     * @return object
     */
    public static function getDbConnection()
    {
        return self::$_db;
    }
}