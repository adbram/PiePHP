<?php
namespace Controller;

class AppController extends \Core\Controller
{
    public function indexAction()
    {
        if(isset($_SESSION['id'])){
            header('Location: '.BASE_URI.'/login');
        } else {
            $films = \Core\ORM::find('film');
            self::render('index', ['films' => $films]);
        }
    }
}