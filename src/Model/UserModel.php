<?php
namespace Model;

class UserModel extends \Core\Entity
{
    public function save()
    {
        if($this->find(['WHERE' => 'email = "'. $this->email.'";']) == false){
            if($this->find(['WHERE' => 'pseudo = "'. $this->pseudo.'";']) == false){
                return $this->create();
            } else {
                return 'pseudo [ KO ]';
            }
        } else {
            return 'email [ KO ]';
        }
    }

    public function connect()
    {
        return $this->find(['WHERE' => 'email = "'. $this->email.'" AND password = "'. $this->password.'";']);
    }
}