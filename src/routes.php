<?php

Core\Router::connect('/', ['controller' => 'app', 'action' => 'index']);
Core\Router::connect('/register', ['controller' => 'users', 'action' => 'viewRegister']);
Core\Router::connect('/login', ['controller' => 'users', 'action' => 'viewLogin']);
Core\Router::connect('/newAccount', ['controller' => 'users', 'action' => 'register']);
Core\Router::connect('/connect', ['controller' => 'users', 'action' => 'login']);
Core\Router::connect('/deconnect', ['controller' => 'users', 'action' => 'logout']);
Core\Router::connect('/user/{id}', ['controller' => 'users' , 'action' => 'show']);