<?php

function loadClass($class) {
    $srcSubFolders = ['Model', 'View', 'Controller'];
    $nameSpace = explode('\\', $class)[0];
    $className = explode('\\', $class)[1];
    if($nameSpace == 'Core'){
        if (file_exists(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), $class . '.php']))) {
            require_once(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), $class . '.php']));
        }
    } elseif(in_array($nameSpace, $srcSubFolders)) {
        if (file_exists(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', $class . '.php']))) {
            require_once(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', $class . '.php']));
        }
    }
}

spl_autoload_register('loadClass');