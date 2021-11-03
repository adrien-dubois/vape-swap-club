<?php

namespace App\Controllers;

use App\Models\Adress;
use App\Models\Order;
use App\Models\OrderHasProduct;
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
     * Display command and form shipment adress
     *
     * @return void
     */
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
     * Create a new adress
     *
     * @return void
     */
    public function order(){

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
        $totalPrice = $total * 1.196;

        // Received and filter adress elements
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
        $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_NUMBER_INT);
        $adress = filter_input(INPUT_POST, 'adress', FILTER_SANITIZE_STRING);
        $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
        $app_user_id = $_SESSION['userId'];


        // Create variables for testing
        $formIsValid = true;
        $errorList = [];

        // Manage mistakes

        if(empty($name)){
            $errorList[] = "Merci de renseigner nom & prénom";
            $formIsValid = false;
        }
        if(empty($number)){
            $errorList[] = "Merci de renseigner le n° de voie";
            $formIsValid = false;
        }
        if(empty($adress)){
            $errorList[] = "Vous devez saisir une adresse de livraison";
            $formIsValid = false;
        }
        if(empty($zip)){
            $errorList[] = "Il faut remplir le code postal";
            $formIsValid = false;
        }
        if(empty($city)){
            $errorList[] = "Merci de préciser la ville de livraison";
            $formIsValid = false;
        }

        // CREATING ADRESS IN DB

        if($formIsValid === true){

            $newAdress = new Adress();
            $newAdress->setName($name);
            $newAdress->setNumber($number);
            $newAdress->setAdress($adress);
            $newAdress->setZip($zip);
            $newAdress->setCity($city);
            $newAdress->setPhone($phone);
            $newAdress->setMessage($message);
            $newAdress->setApp_user_id($app_user_id);

            if($newAdress->save()){

                $adress_id = $newAdress->getId();

                $newOrder = new Order();
                $newOrder->setApp_user_id($app_user_id);
                $newOrder->setAdress_id($adress_id);
                $newOrder->setPrice($totalPrice);

                if($newOrder->save()){

                    $order_id = $newOrder->getId();

                    $newOrderProducts = new OrderHasProduct();

                    foreach ($cart as $key => $value) {
                        $newOrderProducts->setOrder_id($order_id);
                        $newOrderProducts->setProduct_id($key);
                        $newOrderProducts->addOrderProduct();
                    }
                    
                    header('Location: ' . $this->router->generate ('cart-confirm', ['orderId'=>$order_id]));

                }
                $errorList[] = "Une erreur s'est produite lors de l'enregistrement, merci réessayer plus tard";
                
            }

            $errorList[] = "Une erreur s'est produite lors de l'enregistrement, merci réessayer plus tard";
        }
        $errorList[] = "Une erreur s'est produite lors de l'enregistrement, merci réessayer plus tard";

        $this->show('cart/command',[
            'pageTitle' => 'Commande',
            'errorList' => $errorList,
            'cart' => $getCart,
            'total' => $total,
            'totalTva' => $totalTva,
        ]);
    }

    /**
     * Displaying all summary of the order before payment
     *
     * @param int $order_id
     * @return void
     */
    public function confirm($order_id){

        $orderModel = new Order();
        $adressModel = new Adress();
        $currentOrder = $orderModel->find($order_id);

        $_SESSION['order'] = $currentOrder;

        $relatedAdress = $currentOrder->getAdress_id();

        $adress = $adressModel->find($relatedAdress);
        $products = Product::findListForOrder($order_id);

        $this->show('cart/confirm', [
            'pageTitle' => 'Confirmation commande',
            'order' => $currentOrder,
            'products' => $products,
            'adress' => $adress,
        ]);
    }

     /**
     * Method wich manages the paiement with stripe
     *
     * @return void
     */
    public function paiement(){

        $order = $_SESSION['order'];
        $order_id = $order->getId();
        $currentOrder = Order::find($order_id);
        $relatedAdress = $currentOrder->getAdress_id();
        $adress = Adress::find($relatedAdress);

        if(isset($_POST['price']) && !empty($_POST['price'])){
            $price = number_format($_POST['price'], 2) ;

            // GET THE STRIPE API SECRET KEY IN THE INI FILE
            $ini = parse_ini_file(__DIR__.'/../config.ini');

            // PUT THE KEY THAT IS IN THE INI FILE HERE
            \Stripe\Stripe::setApiKey($ini['STRIPE_KEY']);
            
            $intent = \Stripe\PaymentIntent::create([
                'amount'=> $price*100,
                'currency'=>'eur',
                'payment_method_types' =>['card'],
                'shipping' => [
                    'address' => [
                        'city' => $adress->getCity(),
                        'postal_code' => $adress->getZip(),
                        'line1' => $adress->getNumber() .' '. $adress->getAdress(),
                    ],
                    'name' => $adress->getName()
                ],
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

    /**
     * Redirection after payment is confirmed, send a confirmation mail, empty the cart, & change the stock and the status of the order.
     *
     * @return void
     */
    public function cartRedirect(){

        // Variable for the confirmation mail
        $connectedUser = $_SESSION['userObject'];
        $currentOrder = $_SESSION['order'];
        $order_id = $currentOrder->getId();

        // Mail construction with elements
        $recipient = $connectedUser->getEmail();
        $subject = 'Confirmation de votre commande - Vape Swap Club';

        $body = '
                <h2>Confirmation de votre commande n°' . $order_id .' <strong>Vape Swap Club</strong> </h2>

                <p> Bonjour ' . $_SESSION['username'] .', la commande que vous venez de passer chez nous, d\'un montant de ' . $currentOrder->getPrice()  .  ' € viens d\'être confirmée et est actuellement en préparation.</p>
                <br>
                <p>Vous recevrez bientôt un mail quand la commande sera expédiée, ainsi que le numéro de suivi afin de savoir où en est cotre commande, à tout moment.</p>
                <br>
                <p>Merci de votre confiance, bonne vape, </p>
                <p><i>Vape Swap Club</i></p>
        ';
        // Send the confirmation email
        $this->sendmail($subject, $body, $recipient);

        // Get the order
        $updateStatus = Order::find($order_id);

        // Update status on paid
        $updateStatus->setStatus(2);
        $updateStatus->update();

        // Get all products that are selled on this order and foreach, update status on out of stock
        $products = Product::findListForOrder($order_id);
        foreach($products as $currentProduct){
            $currentProduct->setStatus(2);
            $currentProduct->update();
        }
        
        // Unset cart & order on session
        unset($_SESSION['cart']);
        unset($_SESSION['order']);

        // Display that payment is well done
        self::addFlash(
            'success',
            'Votre paiement a bien été accepté'
        );

        // And display redirection page
        $this->show('cart/redirect', [
            'pageTitle' => 'Paiement accepté'
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
}