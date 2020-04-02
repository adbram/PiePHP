<?php

# set your url rules from the more specific to the less one

Core\Router::connect('/signin', ['controller' => 'user' , 'action' => 'signIn']);
Core\Router::connect('/addaccount', ['controller' => 'user' , 'action' => 'add']);
Core\Router::connect('/user/{id}', ['controller' => 'user' , 'action' => 'show']);