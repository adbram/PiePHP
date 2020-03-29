<?php
namespace Controller ;

class AppController extends \Core\Controller
{
    public function deleteAction()
    {
        echo $this->_userModelObj->delete(20) . ' deleted rows<br>';
    }
}