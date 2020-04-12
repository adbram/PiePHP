<?php
namespace Controller;

class FilmController extends \Core\Controller
{
    public function detailsAction($params)
    {
        if(!isset($_SESSION['id'])){
            header('Location: '.BASE_URI.'/login');
        } elseif(isset($_POST['password'])){
            $user = new \Model\UserModel(['id' => $_SESSION['id']]);
            $params = $this->_requestObj->getQueryParams();
            if(hash('ripemd160', $params['password']) == $user->password){
                $id = array_shift($params);
                $film =  new \Model\FilmModel(['id' => $id]);
                $film->delete($film->id);
                header('Location: '.BASE_URI);
            } else {
                $id = array_shift($params);
                $film =  new \Model\FilmModel(['id' => $id]);
                self::render('film', ['film' => $film, 'error' => 'Mot de passe incorrecte']);
            }
        } else {
            $film = new \Model\FilmModel(['id' => $params[0]]);
            self::render('film', ['film' => $film]);
        }
    }

    public function editAction($params)
    {
        if(!isset($_SESSION['id'])){
            header('Location: '.BASE_URI.'/login');
        } elseif(isset($_POST['titre'])){
            $paramsII = $this->_requestObj->getQueryParams();
            $id = array_shift($paramsII);
            $film =  new \Model\FilmModel(['id' => $id]);
            $film->edit($paramsII);
            header('Location: '.BASE_URI);
        } else {
            $film = new \Model\FilmModel(['id' => $params[0]]);
            $genres = new \Model\GenreModel(['id' => 1]);
            $genres = $genres->find(['WHERE' => 1, 'ORDER BY' => 'id']);
            self::render('edit', ['film' => $film, 'genres' => $genres]);
        }
    }

    public function addAction()
    {
        $genres = new \Model\GenreModel(['id' => 1]);
        $genres = $genres->find(['WHERE' => 1, 'ORDER BY' => 'id']);
        if(!isset($_SESSION['id'])){
            header('Location: '.BASE_URI.'/login');
        } elseif(isset($_POST['titre'])){
            $params = $this->_requestObj->getQueryParams();
            if($this->checkData($params, $genres) == true){
                $film = new \Model\FilmModel($params);
                $film->create();
                header('Location: '.BASE_URI);
            }
        } else{
            $genres = new \Model\GenreModel(['id' => 1]);
            $genres = $genres->find(['WHERE' => 1, 'ORDER BY' => 'id']);
            self::render('add', ['genres' => $genres]);
        }
    }

    public function checkData($data, $dataa = '', $file = 'add')
    {
        foreach($data as $key => $value) {
            if($value == '') {
                self::render($file, ['error' => 'Tous le champs doivent être complétés.', 'genres' => $dataa]);
                return false;
            } else {
                return true;
            }
        }
    }
}