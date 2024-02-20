<?php
use API\config;
use API\controllers;
use API\models;
require_once('../vendor/autoload.php');
$router = new AltoRouter();

//Mapage des routes
$router->map( 'GET', 'api/users/create', function() {
    require __DIR__ . '/controllers/UsersController.php';
  
});