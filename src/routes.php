<?php

# set your url rules from the more specific to the less one

Core\Router::connect('/user/{id}', ['controller' => 'users' , 'action' => 'show']);