<?php
namespace Core ;

class Controller
{
    protected $_requestObj;
    protected static $_render;

    public function __construct()
    {
        $this->_requestObj = new \Core\Request($_POST, $_GET);
    }

    protected function render($requiredView, $scope = []) {
        extract($scope);
        $template = implode(DIRECTORY_SEPARATOR, [dirname( __DIR__ ), 'src', 'View', str_replace('Controller', '', basename(get_class($this))), $requiredView]) . '.php';
        if(file_exists($template)) {
            $originalContent = file_get_contents($template);
            TemplateEngine::parsePHP($template);
            ob_start();
            include($template);
            $view = ob_get_clean();
            ob_start();
            include(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', 'index']) . '.php');
            self::$_render = ob_get_clean();
            file_put_contents($template, $originalContent);
        }
    }

    public static function pagination($elements, $currentPage, $elementsByPage = 2)
    {
        $nbElements = count($elements);
        $nbPages = ceil($nbElements / $elementsByPage);
        if($currentPage == 0 || $currentPage > $nbPages){
            $currentPage = 1;
        }
        $start = ($currentPage - 1) * $elementsByPage;
        $elements = array_slice($elements, $start, $elementsByPage);
        return ['elements' => $elements, 'nbPages' => $nbPages, 'currentPage' => $currentPage];
    }

    public function __destruct() {
        echo self::$_render;
    }
}