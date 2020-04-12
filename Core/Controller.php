<?php
namespace Core ;

/**
 * Controller
 * Les methodes de cette classe appellent le bon model et la bonne vue en fonction de l'url (voir la classe Router pour plus de details concernant la gestion des urls)
 */
class Controller
{
    /**
     * _requestObj
     *
     * @var mixed objet qui nous permettra de recevoir les donnees GET et POST "securisees"
     */
    protected $_requestObj;
    protected static $_render;

    public function __construct()
    {
        $this->_requestObj = new \Core\Request($_POST, $_GET);
    }

    /**
     * render
     *
     * @param  mixed $requiredView la "vue" a appeler (elle doit se trouver dans un des sous-dossiers de "src/View", expl: si le controller est "\Controller\UserController" alors ses "vues" doivent se trouver dans le sous-dossier "User" de "src/View")
     * @param  mixed $scope si la "vue" a besoin de variables pour son bon-fonctionnement, alors donnez-lui ces dernieres dans cette variable (array), expl: ma vue a besoin de la variable "$erreur" qui a comme valeur "email incorrecte", dans ce cas, en deuxieme argument je donnerai un array associatif, ou chaque element donnera "naissance" a une variable avec comme valeur la valeur de ce dernier, et comme nom de la variable l'index de l'element
     * @return void
     */
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

    /**
     * pagination
     *
     * @param  mixed $elements les elements a "paginer"
     * @param  mixed $currentPage
     * @param  mixed $elementsByPage nombre d'elements par page
     * @return void
     */
    public static function pagination($elements, $currentPage, $elementsByPage = 15)
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