<?php

Core\Router::connect('/', ['controller' => 'app', 'action' => 'index']);
Core\Router::connect('/register', ['controller' => 'user', 'action' => 'viewRegister']);
Core\Router::connect('/login', ['controller' => 'user', 'action' => 'viewLogin']);
Core\Router::connect('/newAccount', ['controller' => 'user', 'action' => 'register']);
Core\Router::connect('/connect', ['controller' => 'user', 'action' => 'login']);
Core\Router::connect('/deconnect', ['controller' => 'user', 'action' => 'logout']);