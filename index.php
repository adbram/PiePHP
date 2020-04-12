<?php
session_start();

define('BASE_URI', str_replace('\\', '/', substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']))));
require_once(implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']));

$setup = new Core\Setfiles(['article', 'commentaire', 'like']);
$app = new Core\Core;
$app->run($_SERVER['REQUEST_URI']);