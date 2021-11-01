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

    public function command(){

        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }

        $total = 0;
        $cart = $_SESSION['cart'];

        if(isset($cart)){
            foreach ($cart as $key => $value) {
                $getCart[$key] = Product::find($key);
            }
            foreach($getCart as $product){
                $total += $product->getPrice() * $_SESSION['cart'][$product->getId()];
            }
        }

        $totalTva = number_format($total * 1.196,2,',',' ');

        $this->show('cart/command',[
            'pageTitle'=>'Commande',
            'cart' => $getCart,
            'total' => $total,
            'totalTva' => $totalTva,
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

    /**
     * Method which will epty etire cart to abort command
     *
     * @return void
     */
    public function emptyCart(){
        if(isset($_SESSION['cart'])){
            unset($_SESSION['cart']);
        }

        self::addFlash(
            'danger',
            'La commande a été annulée'
        );
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }


    /**
     * Method wich manages the paiement with stripe
     *
     * @return void
     */
    public function paiement(){

        if(isset($_POST['price']) && !empty($_POST['price'])){
            $price = $_POST['price'];

            // GET THE STRIPE API SECRET KEY IN THE INI FILE
            $ini = parse_ini_file(__DIR__.'/../config.ini');

            // PUT THE KEY THAT IS IN THE INI FILE HERE
            \Stripe\Stripe::setApiKey($ini['STRIPE_KEY']);
            
            $intent = \Stripe\PaymentIntent::create([
                'amount'=> $price*100,
                'currency'=>'eur',
                'payment_method_types' =>['card'],
                
            ]);


        } else {
            $this->router->generate('cart-home');
        }

        $this->show('cart/paiement',[
            'intent'=>$intent,
            'pageTitle'=>'Paiement'
        ]);
    }

    public function cardForm(){

        $this->show('cart/paiement',[
            'pageTitle'=>"Paiement"
        ]);
    }

    public function cartRedirect(){

        unset($_SESSION['cart']);

        self::addFlash(
            'success',
            'Votre paiement a bien été accepté'
        );

        $this->show('cart/redirect');
    }
}