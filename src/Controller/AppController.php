<?php
namespace Controller;

class AppController extends \Core\Controller
{
    public function indexAction($page = 1)
    {
        $page = intval($page);
        if(isset($_SESSION['id'])){
            header('Location: '.BASE_URI.'/login');
        } else {
            $films = \Core\ORM::find('film');
            $films = self::pagination($films, $page);
            self::render('index', ['films' => $films['elements'], 'nbPages' => $films['nbPages'], 'currentPage' => $films['currentPage']]);
        }
    }

    public function searchAction($params)
    {
        $toSearch = $params[0];
        $page = intval($params[1]);
        $films = \Core\ORM::find('film', ["WHERE" => 'titre', "LIKE" => "'%$toSearch%'"]);
        $films = self::pagination($films, $page);
        self::render('index', ['films' => $films['elements'], 'nbPages' => $films['nbPages'], 'currentPage' => $films['currentPage']]);
    }

    public function lifeHackAction(...$trash)
    {
        header('Location: '.BASE_URI.'/search/'.$this->_requestObj->getQueryParams()['s'].'/page/1');
    }
}