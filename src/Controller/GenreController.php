<?php
namespace Controller;

class GenreController extends \Core\Controller
{
    public function indexAction()
    {
        if(!isset($_SESSION['id'])){
            header('Location: '.BASE_URI.'/login');
        } elseif(isset($_POST['nom'])){
            $params = $this->_requestObj->getQueryParams();
            echo '<pre>', var_dump($params), '</pre>';
            $genres = new \Model\GenreModel($params);
            $genres->create();
            header('Location: '.BASE_URI . '/genres');
        } else{
            $genres = new \Model\GenreModel(['id' => 1]);
            $genres = $genres->find(['WHERE' => 1, 'ORDER BY' => 'nom']);
            self::render('index', ['genres' => $genres]);
        }
    }

    public function deleteAction($params)
    {
        if(!isset($_SESSION['id'])){
            header('Location: '.BASE_URI.'/login');
        } else{
            $genre = new \Model\GenreModel(['id' => $params[0]]);
            $genre->delete($genre->id);
            header('Location: '.BASE_URI.'/genres');
        }
    }
}