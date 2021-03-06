<?php
namespace Core ;

/**
 * Core lance votre application
 */
class Core
{
    public function __construct()
    {
        require_once(implode(DIRECTORY_SEPARATOR,  ['src', 'routes.php']));
        require_once(implode(DIRECTORY_SEPARATOR,  ['src', 'dbconnection.php']));
    }

    /**
     * run
     *
     * @param  mixed $url
     * @return void
     * Instance la classe, et appelle la methode retournees par la classe "Router"
     */
    public function run($url)
    {
        $response = Router::get($url);
        $class = $response[0];
        $method = $response[1];

        if(class_exists($class)){
            $obj = new $class();
            if(method_exists($obj, $method)){
                if(isset($response[2])){
                    $obj->$method($response[2]);
                } else {
                    $obj->$method();
                }
            } else {
                echo '<img id="quattre" src="webroot/assets/404.gif">';
            }
        } else {
            echo '<img id="quattre" src="webroot/assets/404.gif">';
        }
    }
}