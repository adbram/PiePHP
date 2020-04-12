<?php
namespace Core ;

/**
 * Router dirige les requetes vers la bonne classe et sa methode
 */
class Router
{
    private static $_routes = [];

    /**
     * connect ajoute une route dans "_routes", ou sont stockes tous les url pris en compte par votre site, on assigne chaque url une classe et une methode
     *
     * @param  mixed $staticUrl l'url a gerer
     * @param  mixed $route la methode et la classe a utiliser
     * @return void
     */
    public static function connect($staticUrl, $route)
    {
        $explodedStaticUrl = explode('/', $staticUrl);
        $regex = false;

        foreach ($explodedStaticUrl as $key => $value) {
            if(substr($value, 0, 1) == '{' && substr($value, -1) == '}') {
                $regex = true;
                $explodedStaticUrl[$key] = '([^\/]*)';
            }
        }
        $finalStaticUrl = '/^'.implode('\/', $explodedStaticUrl).'\/?$/';

        if(!isset(self::$_routes[$finalStaticUrl])) {
            self::$_routes[$finalStaticUrl] = $route;
        }
    }

    /**
     * get retourne les bons elements a utiliser selon l'url donne, si cet url n'a pas ete assigne a un route, on essayera de la definir dynamiquement
     *
     * @param  mixed $url
     * @return array index 0 => class, index 1 => methode
     */
    public static function get($url)
    {
        $slicedUrl = str_replace(BASE_URI, '', $url);
        $explodedUrl = explode('/', $slicedUrl);
        $useLessPart1 = array_shift($explodedUrl);
        if($explodedUrl[array_key_last($explodedUrl)] == '') {
            $useLessPart2 = array_pop($explodedUrl);
        }

        if(!empty(self::$_routes)) {
            foreach(self::$_routes as $urlII => $controllerAndAction) {
                if(preg_match($urlII, $slicedUrl, $matches)) {
                    $class = 'Controller\\' . ucfirst($controllerAndAction['controller']) . 'Controller';
                    $method = $controllerAndAction['action'] . 'Action';
                    if(isset($matches[1])) {
                        $toRm = array_shift($matches);
                        return [$class, $method, $matches];
                    }
                    return [$class, $method];
                }
            }
        }

        if ((isset($explodedUrl[0]) && isset($explodedUrl[1]))){
            $class = 'Controller\\' . ucfirst($explodedUrl[0]) . 'Controller';
            $method = $explodedUrl[1] . 'Action';
        } elseif (isset($explodedUrl[0]) && !isset($explodedUrl[1])) {
            $class = 'Controller\\' . ucfirst($explodedUrl[0]) . 'Controller';
            $method = $explodedUrl[0] . 'Action';
            if(class_exists($class)){
                $method = 'indexAction';
            } elseif (method_exists($obj = new \Controller\AppController, $method)) {
                $class = 'Controller\AppController';
            }
        } else {
            $class = 'Controller\AppController';
            $method = 'indexAction';
        }
        return [$class, $method];
    }
}