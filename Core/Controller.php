<?php
namespace Core ;

class Controller
{
    protected $_userModelObj;
    private static $_render;

    public function __construct()
    {
        $this->_userModelObj = new \Model\UserModel($_POST);
    }

    protected function render($requiredView, $scope = []) {
        extract($scope, EXTR_PREFIX_ALL, 'scopeElement_');
        $template = implode(DIRECTORY_SEPARATOR, [dirname( __DIR__ ), 'src', 'View', str_replace('Controller', '', basename(get_class($this))), $requiredView]) . '.php';
        if(file_exists($template)) {
            ob_start();
            include($template);
            $view = ob_get_clean();
            ob_start();
            include(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', 'index']) . '.php');
            self::$_render = ob_get_clean();
        }
    }

    public function __destruct() {
        echo self::$_render;
    }
}