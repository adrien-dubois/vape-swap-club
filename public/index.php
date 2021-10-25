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

$router->map(
        'POST',
        '/',
        [
            'method' => 'connect',
            'controller' => '\App\Controllers\AppUserController'
        ],
        'main-connect'

);

$router->map(
    'GET',
    '/logout',
    [
        'method' => 'logout',
        'controller' => '\App\Controllers\AppUserController'
    ],
    'main-logout'
);

/* -----------
--- PRODUCT ---
------------*/

$router->map(
    'GET',
    '/products',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-list'
);

$router->map(
    'GET',
    '/products/[i:productId]',
    [
        'method' => 'single',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-single'
);

/* -----------
--- USERS  ---
------------*/

$router->map(
    'GET',
    '/register',
    [
        'method' => 'register',
        'controller' => '\App\Controllers\AppUserController'
    ],
    'main-register'

);

$router->map(
    'POST',
    '/register',
    [
        'method' => 'insert',
        'controller' => '\App\Controllers\AppUserController'
    ],
    'user-insert'

);

/* -------------
--- DISPATCH ---
-------------*/


$match = $router->match();


$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

$dispatcher->setControllersArguments($match, $router);

$dispatcher->dispatch();