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
        self::checkData($params);
    }

    private static function checkData($data)
    {
        foreach($data as $key => $value) {
            if(strlen($value) > 50 || $value == '') {
                echo "initialisation $key => $value ".strlen($value)." [ KO ]<br>";
                return false;
            }
        }
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            echo 'email [ KO ]<br>';
            return false;
        } elseif (!preg_match('/^(?=.*[0-9]+)(?=.*[a-z]+)(?=.*[A-Z]+).{8,20}$/', $data['password'])) {
            echo 'mdp [ KO ]<br>';
            return false;
        } elseif (!preg_match('/^([A-Za-z\-]+)+$/', $data['prenom']) || !preg_match('/^([A-Za-z\-]+)+$/', $data['nom'])) {
            echo 'prenom, nom [ KO ]<br>';
            return false;
        } elseif (!preg_match('/^([A-Za-z0-9\_]+)+$/', $data['pseudo'])) {
            echo 'pseudo [ KO ]<br>';
            return false;
        } else {
            $birthDate = new \DateTime($data['date_naissance']);
            $today = new \DateTime('now');
            $interval = $birthDate->diff($today);
            $age =   intval($interval->format('%R%Y'));
            if($age < 18 || $age > 100) {
                echo 'age [ KO ]<br>';
                return false;
            }
        }
        echo 'check [ OK ]<br>';
        $data['password'] = hash('ripemd160', $data['password']);
        $user = new \Model\UserModel($data);
        if(!isset($user->id)) {
            $id = $user->save();
            echo '<pre>', var_dump($id), '</pre>';
            if($id != false && $id != 'email [ KO ]' && $id != 'pseudo [ KO ]'){
                $user->id = $id;
                echo 'Vous etes maintenat inscrit, votre id est le numero "'. $user->id . '"<br>';
            } else {
                echo 'Inscription echouee<br>';
            }
        }
    }
}