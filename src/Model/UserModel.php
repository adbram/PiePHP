<?php
namespace Model ;
use \PDO;

class UserModel
{
    private $_email;
    private $_password;
    private static $_db;

    public function __construct($data = [])
    {
        self::$_db = new  PDO('mysql:host=127.0.0.1;dbname=piephp;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $this->hydrate($data);
    }

    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function setEmail($email)
    {
        $email = htmlspecialchars($email);
        if(filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) <= 30) {
            $this->_email = $email;
            echo 'email [ OK ]<br>';
        } else {
            echo 'email [ KO ]<br>';
        }
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setPassword($password)
    {
        if(preg_match('/^(?=.*[0-9]+)(?=.*[a-z]+)(?=.*[A-Z]).{8,20}$/', $password)) {
            $this->_password = hash('ripemd160', $password);
            echo 'password [ OK ]<br>';
        } else {
            echo 'password [ KO ]<br>';
        }
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function login()
    {
        if($this->getEmail() != NULL && $this->getPassword() != NULL) {
            $req = self::$_db->prepare('SELECT * FROM users WHERE email = :email AND password = :password;');
            $req->execute(['email' => $this->getEmail(), 'password' => $this->getPassword()]);
            if($req->rowCount() != 0) {
                $_SESSION['email'] = $this->getEmail();
                echo 'login [ OK ]<br>';
            } else {
                echo 'login [ KO ]<br>';
            }
        }
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
    }

    public function save() // alias create
    {
        if($this->getEmail() != NULL && $this->getPassword() != NULL) {
            $req = self::$_db->prepare('INSERT INTO users (email, password) VALUES (:email, :password);');
            $req->execute(['email' => $this->getEmail(), 'password' => $this->getPassword()]);
            echo 'save [ OK ]<br>';
        } else {
            echo 'save [ KO ]<br>';
        }
    }

    public function read($id)
    {
        $req = self::$_db->prepare('SELECT * FROM users WHERE id = :id ;');
        $req->execute(['id' => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id)
    {
        $req = self::$_db->prepare('UPDATE users SET email = :email, password = :password;');
        $req->execute(['email' => $this->getEmail(), 'password' => $this->getPassword()]);
    }

    public function delete($id)
    {
        $req = self::$_db->prepare('DELETE FROM users WHERE id = :id ;');
        $req->execute(['id' => $id]);
        return $req->rowCount();
    }

    public function readAll()
    {
        $toReturn = [];
        $req = self::$_db->query('SELECT * FROM users;');
        while($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $toReturn['user-'.$data['id']] = $data;
        }
        return $toReturn;
    }
}