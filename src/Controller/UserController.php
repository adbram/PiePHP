<?php
namespace Controller;

class UserController extends \Core\Controller
{
    public function loginAction()
    {
        $params = $this->_requestObj->getQueryParams();
        if(empty($params)){
            self::render('login');
        } else {
            $params['password'] = hash('ripemd160', $params['password']);
            $user = new \Model\UserModel($params);
            $check = $user->connect();
            if($check != false){
                $_SESSION['id'] = $check[array_key_first($check)]['id'];
                $_SESSION['pseudo'] = $check[array_key_first($check)]['pseudo'];
            } else {
                self::render('login', ['error' => 'Email ou mot de passe incorrecte.']);
            }
        }
    }

    public function signinAction()
    {
        $params = $this->_requestObj->getQueryParams();
        if(empty($params)){
            self::render('signin');
        } else {
            if(self::checkData($params) == true){
                $params['password'] = hash('ripemd160', $params['password']);
                $user = new \Model\UserModel($params);
                if(!isset($user->id)) {
                    $id = $user->save();
                    if($id == 'email [ KO ]'){
                        self::render('signin', ['error' => 'Un compte a déjà été crée avec cet email.']);
                    } elseif ($id == 'pseudo [ KO ]') {
                        self::render('signin', ['error' => 'Pseudonyme déjà utilisé.']);
                    } else {
                        self::render('signin', ['created' => true]);
                    }
                }
            }
        }
    }

    public function indexAction()
    {
        echo 'indexAction [ OK ]<br>';
        $user = new \Model\UserModel(['id' => 1]);
        // echo '<pre>', var_dump($user->historique), '</pre>';
        // echo '<pre>', var_dump($user->read(1)), '</pre>';
        echo '<pre>', var_dump($user->find()), '</pre>';
    }

    public function checkData($data)
    {
        foreach($data as $key => $value) {
            if(strlen($value) > 50 || $value == '') {
                self::render('signin', ['error' => 'Tous le champs doivent être complétés, et ne doivent pas dépasser 50 caractères.']);
                return false;
            }
        }
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            self::render('signin', ['error' => 'Email invalide.']);
            return false;
        } elseif (!preg_match('/^(?=.*[0-9]+)(?=.*[a-z]+)(?=.*[A-Z]+).{8,20}$/', $data['password'])) {
            self::render('signin', ['error' => 'Mot de passe invalide, il doit contenir entre 8 et 20 caractères,
             dont au moins une lettre miniscule, une majuscule, et au moins un chiffre.']);
            return false;
        } elseif (!preg_match('/^([A-Za-z\-]+)+$/', $data['prenom']) || !preg_match('/^([A-Za-z\-]+)+$/', $data['nom'])) {
            self::render('signin', ['error' => 'Prenom ou nom invalide, ils ne doivent contenir ni des caractères spéciaux (mis à part "-"), ni des chiffres.']);
            return false;
        } elseif (!preg_match('/^([A-Za-z0-9\_]+)+$/', $data['pseudo'])) {
            self::render('signin', ['error' => 'Pseudo invalide, il ne doit pas contenir de caractères spéciaux (mis à part "-" et "_").']);
            return false;
        } else {
            $birthDate = new \DateTime($data['date_naissance']);
            $today = new \DateTime('now');
            $interval = $birthDate->diff($today);
            $age =   intval($interval->format('%R%Y'));
            if($age < 16 || $age > 100) {
                self::render('signin', ['error' => 'Vous devez être agé·e de minimum 16 ans.']);
                return false;
            }
        }
        return true;
    }
}