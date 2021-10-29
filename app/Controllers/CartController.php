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
       
        // Test if the cart is set, either set it as an array
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }

        // Set the total price at zero
        $total = 0;
        // And the cart in a var
        $cart = $_SESSION['cart'];

        // Get all the products in cart in DB if the cart is set
        if(isset($cart)){
            foreach ($cart as $key => $value) {
                $getCart[$key] = Product::find($key);
            }
            // calculate the total price of the cart including quantities
            foreach($getCart as $product){
                $total += $product->getPrice() * $_SESSION['cart'][$product->getId()];
            }
        }

        $this->show('cart/cart', [
            'cart' => $getCart,
            'pageTitle' => 'Panier',
            'total' => $total,
        ]);
    }


    /**
     * Add a product to cart
     *
     * @param int $productId
     * @return void
     */
    public function addToCart($productId){

        // If the product is already in cart, then increment it of one unit, if not, set it to one
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

        // If the selected product is well in the cart, then unset it to remove it in the cart
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