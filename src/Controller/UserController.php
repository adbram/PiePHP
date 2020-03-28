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
        $this->_userModelObj->save();
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