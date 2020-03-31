<?php
namespace Core ;

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

        echo $class . ' ' . $method . '<br>';
        if(class_exists($class)){
            $obj = new $class();
            if(method_exists($obj, $method)){
                if(isset($response[2])){
                    $obj->$method(implode(', ', $response[2]));
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





// if($reponse != false) {
//     $class = 'Controller\\' . ucfirst($reponse['controller']) . 'Controller';
//     $method = $reponse['action'] . 'Action';
// } else {
//     $explodedUrl = explode('/', $url);
//     if(isset($explodedUrl[2]) && isset($explodedUrl[3])){
//         $class = 'Controller\\' . ucfirst($explodedUrl[2]) . 'Controller';
//         $method = $explodedUrl[3] . 'Action';
//     } elseif ((isset($explodedUrl[2]) && !isset($explodedUrl[3])) && $explodedUrl[2] != '') {
//         $class = 'Controller\\' . ucfirst($explodedUrl[2]) . 'Controller';
//         $method = $explodedUrl[2] . 'Action';
//         if(class_exists($class)){
//             $method = 'indexAction';
//         } elseif (method_exists($obj = new \Controller\AppController, $method)) {
//             $class = 'Controller\AppController';
//         }
//     } else {
//         $class = 'Controller\AppController';
//         $method = 'indexAction';
//     }
// }
