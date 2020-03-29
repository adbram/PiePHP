<?php
namespace Controller ;

class UserController extends \Core\Controller
{
    public function viewRegisterAction()
    {
        self::render('register');
    }

    public function registerAction()
    {
        $params = $this->_requestObj->getQueryParams();
        // $params = ['id' => 1, 'email' => 'aqqqqdnane.berramou@epitech.eu', 'password' => 'asdASD123'];
        $user = new \Model\UserModel($params);
        if(!$user->id) {
            $user->save();
            self::$_render = "Votre compte a ete cree.<br>";
        }
    }

    public function viewLoginAction()
    {
        self::render('login');
    }

    public function loginAction()
    {
        $this->_userModelObj->login();
    }

    public function logoutAction()
    {
        $this->_userModelObj->logout();
    }
}