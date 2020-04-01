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
        // // $params = $this->_requestObj->getQueryParams();
        // $params = ['email' => 'salutatous', 'password' => 'salutsalut'];
        // $user = new \Model\UsersModel($params, ['has many' => 'comment']);
        // if(!isset($user->id)) {
        //     // $user->save();
        //     self::$_render = "Votre compte a ete cree.<br>";
        // }
        // $postsecurise = \Core\Request::security($_POST);
        // echo '<pre>', var_dump($post), '</pre>';





        $post = $this->_requestObj->getQueryParams(); //n 1 securiser les donnees
        $obj = new \Model\UsersModel($post); // n 2 instacienr le model en lui donnant les donnees
        $obj->save();// n 3 appeler la fonction du model qui ajoute une entree dans la bdd







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
        self::render('show', ['id' => $id]);
    }
}