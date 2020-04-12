<?php
namespace Controller;

class UserController extends \Core\Controller
{
    public function loginAction()
    {
        if(isset($_SESSION['id'])){
            header('Location: '.BASE_URI.'/');
        } else {
            $params = $this->_requestObj->getQueryParams();
            if(empty($params)){
                self::render('login');
            } else {
                $params['password'] = hash('ripemd160', $params['password']);
                $user = new \Model\UserModel($params);
                $check = $user->connect();
                if($check != false){
                    $_SESSION['id'] = $check[0]->id;
                    $_SESSION['pseudo'] = $check[0]->pseudo;
                    header('Location: '.BASE_URI.'/');
                } else {
                    self::render('login', ['error' => 'Email ou mot de passe incorrecte.']);
                }
            }
        }
    }

    public function signinAction()
    {
        if(isset($_SESSION['id'])){
            header('Location: '.BASE_URI.'/');
        } else {
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
    }

    public function editAction()
    {
        if(!isset($_SESSION['id'])){
            header('Location: '.BASE_URI.'/login');
        } else {
            $user = new \Model\UserModel(['id' => $_SESSION['id']]);
            self::render('editprofil', ['user' => $user]);
            $params = $this->_requestObj->getQueryParams();
            if(empty($params)){
            } else {
                if(hash('ripemd160', $params['passwordII']) == $user->password){
                    if(self::checkData($params, 'editprofil') == true){
                        $params['password'] = hash('ripemd160', $params['password']);
                        unset($params['passwordII']);
                        $user->edit($params);
                        $new = new \Model\UserModel(['id' => $user->id]);
                        if($user->edit($params) == true) {
                            header('Location: '.BASE_URI.'/monprofil');
                        }
                    }
                } else {
                    self::render('editprofil', ['error' => 'Ancien mot de passe incorrecte', 'user' => $user]);
                }
            }
        }
    }

    public function viewProfilAction()
    {
        if(!isset($_SESSION['id'])){
            header('Location: '.BASE_URI.'/login');
        } elseif (isset($_POST['password'])){
            $user = new \Model\UserModel(['id' => $_SESSION['id']]);
            $params = $this->_requestObj->getQueryParams();
            if(hash('ripemd160', $params['password']) == $user->password){
                $user->delete($user->id);
                $this->deconnectAction();
            } else {
                self::render('profil', ['user' => $user, 'error' => 'Ancien mot de passe incorrecte']);
            }
        } else {
            $user = new \Model\UserModel(['id' => $_SESSION['id']]);
            foreach($user->historique as $key => $value){
                $val = new \Model\HistoriqueModel(['id' => $value->id]);
                $user->historique[$key] = $val;
            }
            self::render('profil', ['user' => $user]);
        }
    }

    public function checkData($data, $file = 'signin')
    {
        foreach($data as $key => $value) {
            if(strlen($value) > 50 || $value == '') {
                self::render($file, ['error' => 'Tous le champs doivent être complétés, et ne doivent pas dépasser 50 caractères.']);
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

    public function deconnectAction()
    {
        $_SESSION = [];
        session_destroy();
        header('Location: '.BASE_URI.'/login');
    }

    public function deleteAction()
    {
        $user = new \Model\UserModel(['id' => $_SESSION['id']]);
        $user->delete($user->id);
        $this->deconnectAction();
    }
}