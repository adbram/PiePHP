<?php
namespace Controller ;

class UsersController extends \Core\Controller
{
    public function viewRegisterAction()
    {
        self::render('register');
    }

    public function registerAction()
    {
        // $params = $this->_requestObj->getQueryParams();
        $params = ['email' => 'salutatous', 'password' => 'salutsalut'];
        $user = new \Model\UsersModel($params, ['has many' => 'comment']);
        if(!isset($user->id)) {
            // $user->save();
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

    public function showAction($id)
    {
        self::render('show');
        echo " ID de l' utilisateur a afficher : $id<br>" ;
    }
}