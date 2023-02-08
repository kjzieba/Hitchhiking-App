<?php

require 'Router.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('index', 'DefaultController');
Router::post('login', 'SecurityController');
Router::post('logout', 'SecurityController');
Router::post('register', 'SecurityController');
Router::get('home', 'DefaultController');
Router::get('search', 'RidesController');
Router::get('ride', 'RidesController');
Router::get('rides', 'RidesController');
Router::get('details', 'RidesController');
Router::get('join', 'RidesController');
Router::post('searchUserRides', 'RidesController');
Router::run($path);