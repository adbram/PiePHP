<?php

# set your url rules from the more specific to the less one


Core\Router::connect('/film/{id}', ['controller' => 'film' , 'action' => 'details']);
Core\Router::connect('/ajouterFilm', ['controller' => 'film' , 'action' => 'add']);
Core\Router::connect('/genres', ['controller' => 'genre' , 'action' => 'index']);
Core\Router::connect('/deleteG/{id}', ['controller' => 'genre' , 'action' => 'delete']);
Core\Router::connect('/addH/{id}', ['controller' => 'historique' , 'action' => 'addH']);
Core\Router::connect('/deleteH/{id}', ['controller' => 'historique' , 'action' => 'delete']);
Core\Router::connect('/editerfilm/{id}', ['controller' => 'film' , 'action' => 'edit']);
Core\Router::connect('/signin', ['controller' => 'user' , 'action' => 'signin']);
Core\Router::connect('/login', ['controller' => 'user' , 'action' => 'login']);
Core\Router::connect('/editer', ['controller' => 'user' , 'action' => 'edit']);
Core\Router::connect('/supprimer', ['controller' => 'user' , 'action' => 'delete']);
Core\Router::connect('/deconnexion', ['controller' => 'user' , 'action' => 'deconnect']);
Core\Router::connect('/monprofil', ['controller' => 'user' , 'action' => 'viewProfil']);
Core\Router::connect('/page/{nb}', ['controller' => 'app' , 'action' => 'index']);
Core\Router::connect('/search/page/{nb}?s={str}', ['controller' => 'app' , 'action' => 'lifeHack']);
Core\Router::connect('/search/{str}/page/{nb}', ['controller' => 'app' , 'action' => 'search']);
Core\Router::connect('/search/{str}/gender/{arr}/page/{id}', ['controller' => 'app' , 'action' => 'search']);