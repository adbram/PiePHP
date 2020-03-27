<?php

echo '<pre>', var_dump($_POST), '</pre><br><pre>', var_dump($_GET), '</pre><br><pre>', var_dump($_SERVER), '</pre>';
define('BASE_URI', str_replace('/', '\\', substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']))));
require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));

if(isset($_GET['c']) && isset($_GET['a'])){
    $class = 'Controller\\' . ucfirst($_GET['c']) . 'Controller';
    $method = $_GET['a'] . 'Action';
} elseif (isset($_GET['cORa'])) {
    $class = 'Controller\\' . ucfirst($_GET['cORa']) . 'Controller';
    $method = $_GET['cORa'] . 'Action';
    if(class_exists($class)){
        $method = 'indexAction';
    } elseif (method_exists($obj = new Controller\AppController, $method)) {
        $class = 'Controller\AppController';
    }
} else {
    $class = 'Controller\AppController';
    $method = 'indexAction';
}

if(class_exists($class)){
    echo 'class [ OK ]<br>';
    $obj = new $class();
    if(method_exists($obj, $method)){
        $obj->$method();
    } else {
        echo '404';
    }
} else {
    echo '404';
}