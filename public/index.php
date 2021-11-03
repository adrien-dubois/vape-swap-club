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

$router->map(
    'GET',
    '/register/otp',
    [
        'method' => 'otp',
        'controller' => '\App\Controllers\AppUserController'
    ],
    'user-otp'
);

$router->map(
    'POST',
    '/register/otp',
    [
        'method' => 'activation',
        'controller' => '\App\Controllers\AppUserController'
    ],
    'user-activation'
);


/* -----------
--- CART   ---
------------*/

$router->map(
    'GET',
    '/cart',
    [
        'method' => 'cart',
        'controller' => '\App\Controllers\CartController'
    ],
    'cart-home'
);

$router->map(
    'GET',
    '/cart/command',
    [
        'method' => 'command',
        'controller' => '\App\Controllers\CartController'
    ],
    'cart-command'
);

$router->map(
    'POST',
    '/cart/command',
    [
        'method' => 'order',
        'controller' => '\App\Controllers\CartController'
    ],
    'cart-order'
);

$router->map(
    'GET',
    '/cart/order/[i:orderId]',
    [
        'method' => 'confirm',
        'controller' => '\App\Controllers\CartController'
    ],
    'cart-confirm'
);

$router->map(
    'GET',
    '/cart/add/[i:productId]',
    [
        'method' => 'addToCart',
        'controller' => '\App\Controllers\CartController'
    ],
    'cart-add'
);

$router->map(
    'GET',
    '/cart/del/[i:productId]',
    [
        'method' => 'removeToCart',
        'controller' => '\App\Controllers\CartController'
    ],
    'cart-remove'
);

$router->map(
    'GET',
    '/cart/del',
    [
        'method' => 'emptyCart',
        'controller' => '\App\Controllers\CartController'
    ],
    'cart-empty'
);

$router->map(
    'POST',
    '/cart/pay',
    [
        'method' => 'paiement',
        'controller' => '\App\Controllers\CartController'
    ],
    'cart-paiement'
);

$router->map(
    'GET',
    '/cart/pay',
    [
        'method'=>'cardForm',
        'controller' => '\App\Controllers\CartController'
    ],
    'cart-form'
);

$router->map(
    'GET',
    '/cart/accept',
    [
        'method'=>'cartRedirect',
        'controller' => '\App\Controllers\CartController'
    ],
    'cart-redirect'
);

/* -------------
--- DISPATCH ---
-------------*/


$match = $router->match();


$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

$dispatcher->setControllersArguments($match, $router);

$dispatcher->dispatch();