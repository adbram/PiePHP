<?php

# set your url rules from the more specific to the less one

Core\Router::connect('/signin', ['controller' => 'user' , 'action' => 'signin']);
Core\Router::connect('/login', ['controller' => 'user' , 'action' => 'login']);
Core\Router::connect('/user/{id}', ['controller' => 'user' , 'action' => 'show']);