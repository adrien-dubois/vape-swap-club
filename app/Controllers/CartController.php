<?php

namespace App\Controllers;

use App\Models\Product;

class CartController extends CoreController{

    /**
     * Method which displays cart
     *
     * @return void
     */
    public function cart(){
       
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }

        $cart = $_SESSION['cart'];

        if(isset($cart)){
            foreach ($cart as $key => $value) {
                $getCart[$key] = Product::find($key);
            }
        }

        $this->show('cart/cart', [
            'cart' => $getCart,
            'pageTitle' => 'Panier'
        ]);
    }

    /**
     * Add a product to cart
     *
     * @param int $productId
     * @return void
     */
    public function addToCart($productId){

        if(isset($_SESSION['cart'][$productId])){
            $_SESSION['cart'][$productId] = $_SESSION['cart'][$productId] +1;
        } else {
            $_SESSION['cart'][$productId] = 1 ;
        }

        self::addFlash(
            'success',
            'Produit ajouté au panier'
        );
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /**
     * Remove a product to the cart
     *
     * @param int $productId
     * @return void
     */
    public function removeToCart($productId){

        if(isset($_SESSION['cart'][$productId])){
            unset($_SESSION['cart'][$productId]);
        }

        self::addFlash(
            'danger',
            'Produit supprimé du panier'
        );
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}