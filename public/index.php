<?php

use App\Utils\Database;

require_once '../vendor/autoload.php';

// STARTING SESSION HERE
session_start();

/* -------------
--- ROUTING ---
--------------*/
$router = new AltoRouter();

if (array_key_exists('BASE_URI', $_SERVER)) {

    $router->setBasePath($_SERVER['BASE_URI']);

}

else {

    $_SERVER['BASE_URI'] = '/';
}

/* -----------
--- ROUTES ---
------------*/

$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-home'
);



/* -------------
--- DISPATCH ---
-------------*/


$match = $router->match();


$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

$dispatcher->setControllersArguments($match, $router);

$dispatcher->dispatch();