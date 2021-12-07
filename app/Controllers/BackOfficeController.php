<?php

namespace App\Controllers;

use App\Models\AppUser;
use App\Models\Order;
use App\Models\Product;
use App\Models\Request;

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
            'products'  => $products
        ]);
    }
    
    public function vendor(){

        $request = Request::findAll();

        $this->show('backoffice/request',[
            'pageTitle' => 'Demande vendeur',
            'requests'   => $request,
        ]);
    }

    public function vendorValidate(){

        $userId = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
        $requestId = filter_input(INPUT_POST, 'request_id', FILTER_SANITIZE_NUMBER_INT);

        $errorList = [];

        $updateRole = AppUser::find($userId);
        $updateRole->setRole('Vendor');

        $updateRequest = Request::find($requestId);
        $updateRequest->setAccepted(2);

        if(($updateRequest->update()) && ($updateRole->update())){

            self::addFlash(
                'success',
                'Requête de vendeur validée'
            );

            // exit;
        } else {

            $errorList[] = 'Une erreur s\'est produite, merci d\'essayer plus tard.';
        }

        $request = Request::findAll();

        $this->show('backoffice/request',[
            'pageTitle'  => 'Demande vendeur',
            'requests'   => $request,
            'errorList'  => $errorList,
        ]);

    }
}