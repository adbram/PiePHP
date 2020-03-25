<?php

function loadClass($class) {
    $srcSubFolders = ['Model', 'View', 'Controller'];
    $nameSpace = explode('\\', $class)[0];
    if($nameSpace == 'Core'){
        require_once('\xampp\htdocs\PiePHP\\' . $class . '.php');
    } elseif(in_array($nameSpace, $srcSubFolders)) {
        require_once('\xampp\htdocs\PiePHP\src\\' . $class . '.php');
    }
}

spl_autoload_register('loadClass');