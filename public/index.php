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

$router->map(
    'GET',
    '/contact',
    [
        'method'=> 'contact',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-contact'
);

$router->map(
    'POST',
    '/contact',
    [
        'method'=> 'sendContact',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-sendContact'
);

$router->map(
    'GET',
    '/contact/redirect',
    [
        'method'=> 'redirection',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-redirect'
);

$router->map(
    'GET',
    '/privacy-policy',
    [
        'method'=> 'privacy',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-privacy'
);

$router->map(
    'GET',
    '/mentions-legales',
    [
        'method'=> 'legals',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-legals'
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

$router->map(
    'GET',
    '/products/add',
    [
        'method' => 'add',
        'controller' => 'App\Controllers\ProductController'
    ],
    'product-add'
);

$router->map(
    'POST',
    '/products/add',
    [
        'method' => 'insert',
        'controller' => 'App\Controllers\ProductController'
    ],
    'product-insert'
);

$router->map(
    'GET',
    '/products/add/[i:productId]',
    [
        'method' => 'adding',
        'controller' => 'App\Controllers\ProductController'
    ],
    'product-adding'
);

$router->map(
    'POST',
    '/products/add/[i:productId]',
    [
        'method' => 'insertCarousel',
        'controller' => 'App\Controllers\ProductController'
    ],
    'product-pictures'
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

$router->map(
    'GET',
    '/profil',
    [
        'method' => 'showProfile',
        'controller' => '\App\Controllers\AppUserController'
    ],
    'user-show'
);

$router->map(
    'GET',
    '/profil/edit',
    [
        'method' => 'editProfile',
        'controller' => '\App\Controllers\AppUserController'
    ],
    'user-edit'
);

$router->map(
    'POST',
    '/profil/edit',
    [
        'method' => 'updateProfil',
        'controller' => '\App\Controllers\AppUserController'
    ],
    'user-update'
);

$router->map(
    'GET',
    '/vendor',
    [
        'method' => 'vendor',
        'controller' => '\App\Controllers\AppUserController'
    ],
    'user-vendor'
);

$router->map(
    'POST',
    '/vendor',
    [
        'method' => 'sendRequest',
        'controller' => '\App\Controllers\AppUserController'
    ],
    'user-request'
);

$router->map(
    'GET',
    '/user/delete/[i:userId]',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\AppUserController'
    ],
    'user-delete'
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
    '/adress/edit/[i:adressId]',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\CartController'
    ],
    'adress-update'
);

$router->map(
    'POST',
    '/adress/edit/[i:adressId]',
    [
        'method' => 'editAdress',
        'controller' => '\App\Controllers\CartController'
    ],
    'adress-edit'
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
--- MESSAGES ---
--------------*/

$router->map(
    'GET',
    '/messages',
    [
        'method' => 'home',
        'controller' => 'App\Controllers\MsgController'
    ],
    'msg-home'
);

$router->map(
    'POST',
    '/messages',
    [
        'method' => 'redirectConversation',
        'controller' => 'App\Controllers\MsgController'
    ],
    'msg-redirect'
);

$router->map(
    'GET',
    '/messages/new',
    [
        'method' => 'new',
        'controller' => 'App\Controllers\MsgController'
    ],
    'msg-new'
);

$router->map(
    'POST',
    '/messages/new',
    [
        'method' => 'sendNew',
        'controller' => 'App\Controllers\MsgController'
    ],
    'msg-send'
);

$router->map(
    'GET',
    '/messages/read/[i:recipientId]',
    [
        'method' => 'read',
        'controller' => 'App\Controllers\MsgController'
    ],
    'msg-read'
);

$router->map(
    'POST',
    '/messages/read/[i:recipientId]',
    [
        'method' => 'sendStatic',
        'controller' => 'App\Controllers\MsgController'
    ],
    'msg-submit'
);

$router->map(
    'POST',
    '/messages/chat',
    [
        'method' => 'chat',
        'controller' => 'App\Controllers\MsgController'
    ],
    'msg-chat'
);

$router->map(
    'POST',
    '/messages/load/chat',
    [
        'method' => 'loadChat',
        'controller' => 'App\Controllers\MsgController'
    ],
    'msg-load'
);

$router->map(
    'POST',
    '/messages/load/more',
    [
        'method' => 'loadMore',
        'controller' => 'App\Controllers\MsgController'
    ],
    'msg-more'
);

$router->map(
    'GET',
    '/messages/delete/[i:recipientId]',
    [
        'method' => 'deleteConversation',
        'controller' => 'App\Controllers\MsgController'
    ],
    'msg-delete'
);

/* ---------------
--- BackOffice ---
----------------*/

$router->map(
    'GET',
    '/backoffice',
    [
        'method' => 'home',
        'controller' => 'App\Controllers\BackOfficeController'
    ],
    'backoffice-home'
);

$router->map(
    'GET',
    '/backoffice/user',
    [
        'method' => 'user',
        'controller' => 'App\Controllers\BackOfficeController'
    ],
    'backoffice-user'
);

$router->map(
    'GET',
    '/backoffice/products',
    [
        'method' => 'products',
        'controller' => 'App\Controllers\BackOfficeController'
    ],
    'backoffice-products'
);

$router->map(
    'GET',
    '/backoffice/vendor',
    [
        'method' => 'vendor',
        'controller' => 'App\Controllers\BackOfficeController'
    ],
    'backoffice-vendor'
);

/* -------------
--- DISPATCH ---
-------------*/


$match = $router->match();


$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');

$dispatcher->setControllersArguments($match, $router);

$dispatcher->dispatch();