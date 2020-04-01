<?php
namespace Controller;

class UserController extends \Core\Controller
{
    public function signInAction()
    {
        self::render('signin');
    }

    public function addAction()
    {
        $params = $this->_requestObj->getQueryParams();
        echo '<pre>', var_dump($params), '</pre>';
    }
}