<?php
namespace Core ;

class Router
{
    private static $_routes = [];

    public static function connect($url, $route)
    {
        if(!isset(self::$_routes[$url])) {
            self::$_routes[$url] = $route;
        }
    }

    public static function get($url)
    {
        $toReturn = false;
        if(!empty(self::$_routes)) {
            foreach(self::$_routes as $urlII => $controllerAndAction) {
                if($url == $urlII) {
                    return $controllerAndAction;
                }
            }
        }
        return $toReturn;
    }
}