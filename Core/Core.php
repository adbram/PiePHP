<?php
namespace Core ;
//voir pour afficher la page 404 a la place

class Core
{
    public function __construct()
    {
        require_once(implode(DIRECTORY_SEPARATOR,  ['src', 'routes.php']));
        require_once(implode(DIRECTORY_SEPARATOR,  ['src', 'dbconnection.php']));
    }

    public function run($url)
    {
        $response = Router::get($url);
        $class = $response[0];
        $method = $response[1];

        // echo $class . ' ' . $method . '<br>';
        if(class_exists($class)){
            $obj = new $class();
            if(method_exists($obj, $method)){
                if(isset($response[2])){
                    $obj->$method($response[2]);
                } else {
                    $obj->$method();
                }
            } else {
                echo '404<br>';
            }
        } else {
            echo '404<br>';
        }
    }
}