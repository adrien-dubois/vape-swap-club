<?php

namespace App\Controllers;

use App\Models\Product;

class MainController extends CoreController {


    /**
     * Method displaying homepage
     *
     * @return void
     */
    public function home(){

        // The cards are the 3 last products stored in DB
        $productModel = new Product();
        $newsCards = $productModel->findCards();

        //The Carousel takes the 8 last products in DB just behind the cards 
        $productCarousel = new Product();
        $carousel = $productCarousel->findCarousel();

        $this->show('main/home', [
            'pageTitle' => 'Accueil',
            'carousel' => $carousel,
            'newsCards' => $newsCards,
        ]);
    }

    /**
     * method displaying contact form
     *
     * @return void
     */
    public function contact(){

        $this->show('main/contact',[
            'pageTitle' => 'Contact',
            'csrfToken' => $this->generateToken(),
        ]);
    }

    public function sendContact(){

        // Store posted datas & sanitize
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

        // Variables to manage errors
        $formIsValid = true;
        $errorList = [];

        // Testing if fields are emptys

        if (empty($name)) {
            $errorList[] = "Vous devez renseigner votre nom & prénom";
            $formIsValid = false;
        }

        if (empty($email)) {
            $errorList[] = "Vous devez fournir votre e-mail";
            $formIsValid = false;
        }

        if (empty($message)) {
            $errorList[] = "Vous devez écrire un message";
            $formIsValid = false;
        }

        // If all is OK, then we move to next step
        if($formIsValid === true){

            // Prepare sending email to webmaster

            // The webmaster's mail is hide in the config.ini for gitignore
            $ini = parse_ini_file(__DIR__.'/../config.ini');
            $recipient = $ini['ADMIN_EMAIL'];
            $subject = 'Message du formulaire de contact - Vape Swap Club';
            $body = '
            <h2>Message du formulaire de contact de '. $name.' </h2>
            <br>
            <p>'. $name.' viens de prendre contact avec vous via le formulaire de contact de Vape Swap Club. Voici son e-mail afin de lui répondre : '. $email.'</p>
            <br>
            <p><i>Et voici donc son message :</i></p>
            <br>
            <p><b>'. $message.'</b></p>   
            ';

            $this -> sendmail($subject, $body, $recipient);

            self::addFlash(
                'success',
                'Votre message a bien été envoyé'
            );
            header('Location: ' . $this->router->generate('main-redirect'));
            exit;
        }

        $this->show('main/contact',[
            'pageTitle' => 'Contact',
            'errorList' => $errorList, 
        ]);
    }

    public function redirection(){

        $this->show('main/redirect',[
            'pageTitle' => 'Redirection'
        ]);
    }

    public function privacy(){
        $this->show('main/privacy',[
            'pageTitle' => 'Politique de confidentialité'
        ]);
    }
    public function legals(){
        $this->show('main/legal',[
            'pageTitle' => 'Mentions légales'
        ]);
    }
}