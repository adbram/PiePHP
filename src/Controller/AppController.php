<?php
namespace Controller;

class AppController extends \Core\Controller
{

    public function indexAction($params = 1)
    {
        if(isset($params[0])){
            $page = intval($params[0]);
        } else{
            $page = intval($params);
        }
        if(!isset($_SESSION['id'])){
            header('Location: '.BASE_URI.'/login');
        } else {
            $films = \Core\ORM::find('film');
            $films = self::pagination($films, $page);
            self::render('index', ['films' => $films['elements'], 'nbPages' => $films['nbPages'], 'currentPage' => $films['currentPage']]);
        }
    }

    public function searchAction($params)
    {
        if(isset($params[2])){
            $toSearch = $params[0];
            $typeStr = $params[1];
            $page = intval($params[2]);
            $types = explode('+', strtolower(str_replace('_', ' ', $typeStr)));
            $filmsII = [];
            $films = \Core\ORM::find('film', ["WHERE" => 'titre', "LIKE" => "'%$toSearch%'"]);
            foreach($films as $key => $film){
                if(in_array($film->genre->nom, $types)){
                    $filmsII[] = $film;
                }
            }
            $films = self::pagination($filmsII, $page);
            self::render('index', ['films' => $films['elements'], 'nbPages' => $films['nbPages'], 'currentPage' => $films['currentPage']]);
        } else {
            $toSearch = $params[0];
            $page = intval($params[1]);
            $films = \Core\ORM::find('film', ["WHERE" => 'titre', "LIKE" => "'%$toSearch%'"]);
            $films = self::pagination($films, $page);
            self::render('index', ['films' => $films['elements'], 'nbPages' => $films['nbPages'], 'currentPage' => $films['currentPage']]);
        }
    }

    public function lifeHackAction(...$trash)
    {
        $params = $this->_requestObj->getQueryParams();
        $type = [];
        if(count($params) > 1){
            foreach ($params as $key => $value) {
                if ($key != 's') {
                    $type[] = $key;
                }
            }
            header('Location: '.BASE_URI.'/search/'.$params['s'].'/gender/'.implode('+', $type).'/page/1');
        } else {
            header('Location: '.BASE_URI.'/search/'.$params['s'].'/page/1');
        }
    }
}