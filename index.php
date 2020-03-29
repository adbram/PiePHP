<?php
session_start();

// echo '<pre>', var_dump($_SESSION), '</pre>';//<br><pre>', var_dump($_GET), '</pre><br><pre>', var_dump($_SERVER), '</pre>';
define('BASE_URI', str_replace('\\', '/', substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']))));
require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));

$app = new Core\Core;
$app->run($_SERVER['REQUEST_URI']);

// $orm = new Core\ORM;
// echo '<pre>', var_dump($orm->create('users', ['email' => 'aa','password' => 'bb'])), '</pre>';
// echo '<pre>', var_dump($orm->read('users', 1)), '</pre>';
// echo '<pre>', var_dump($orm->update('users', 21, ['email' => 'vv','password' => 'cc'])), '</pre>';
// echo '<pre>', var_dump($orm->delete('users', 21)), '</pre>';
// echo '<pre>', var_dump($orm->find('users', ['WHERE' => 'email = \'aa\'', 'ORDER BY' => 'email'])), '</pre>';