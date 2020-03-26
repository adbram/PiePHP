<?php
define('BASE_URI', str_replace('/', '\\', substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']))));
require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));

echo '<pre>', var_dump($_POST), '</pre><br><pre>', var_dump($_GET), '</pre><br><pre>', var_dump($_SERVER), '</pre>';

if(isset($_GET['c']) && isset($_GET['a'])){
    $class = 'Controller\\' . ucfirst($_GET['c']) . 'Controller';
    $method = $_GET['a'] . 'Action';
    if(class_exists($class)){
        echo 'class exist<br>';
        $obj = new $class();
        if(method_exists($obj, $method)){
            $obj->$method();
        } else {
            echo '404';
        }
    } else {
        echo '404';
    }
}