<?php
namespace Model ;

class UsersModel extends \Core\Entity
{
    public function save()
    {
        return \Core\ORM::create($this->_table, $this->_allValues);
    }
}










































// public function login()
// {
//     if($this->getEmail() != NULL && $this->getPassword() != NULL) {
//         $req = self::$_db->prepare('SELECT * FROM users WHERE email = :email AND password = :password;');
//         $req->execute(['email' => $this->getEmail(), 'password' => $this->getPassword()]);
//         if($req->rowCount() != 0) {
//             $_SESSION['email'] = $this->getEmail();
//             echo 'login [ OK ]<br>';
//         } else {
//             echo 'login [ KO ]<br>';
//         }
//     }
// }

// public function logout()
// {
//     $_SESSION = [];
//     session_destroy();
// }