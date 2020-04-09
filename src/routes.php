<?php

# set your url rules from the more specific to the less one

Core\Router::connect('/signin', ['controller' => 'user' , 'action' => 'signin']);
Core\Router::connect('/login', ['controller' => 'user' , 'action' => 'login']);
Core\Router::connect('/page/{nb}', ['controller' => 'app' , 'action' => 'index']);
Core\Router::connect('/search/{str}/page/{nb}', ['controller' => 'app' , 'action' => 'search']);
Core\Router::connect('/search/page/{nb}?s={str}', ['controller' => 'app' , 'action' => 'lifeHack']);
Core\Router::connect('/user/{id}', ['controller' => 'user' , 'action' => 'show']);