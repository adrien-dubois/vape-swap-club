<?php

namespace App\Controllers;

use App\Models\AppUser;
use App\Models\Order;
use App\Models\Product;

class BackOfficeController extends CoreController{

    public function home(){

        $articles = Product::findCards();
        $nbProducts = Product::findNbProducts();
        $nbOrders = Order::findNbOrder();
        $nbUsers = AppUser::findNbUsers();
        $vendors = AppUser::findAllForMessages();

        $this->show('backoffice/home', [
            'pageTitle' => 'Backoffice',
            'articles'  => $articles,
            'nbProducts'=> $nbProducts,
            'nbOrders'  => $nbOrders,
            'nbUsers'   => $nbUsers,
            'vendors'    => $vendors
        ]);
    }

    public function user(){

        $users = AppUser::findAll();

        $this->show('backoffice/user',[
            'pageTitle' => 'Utilisateurs',
            'users'     => $users
        ]);
    }

    public function products(){

        $products = Product::findAllForBackOffice();

        $this->show('backoffice/products',[
            'pageTitle' => 'Articles',
            'products' => $products
        ]);
    }
}