<?php
namespace Controller ;

class AppController{

    public function run() {
        echo __CLASS__ . " [ OK ]" . PHP_EOL ;
    }

    public function addAction(){
        echo 'addAction [ OK ]' . PHP_EOL ;
    }

    public function indexAction(){
        echo 'indexAction [ OK ]' . PHP_EOL ;
    }
}