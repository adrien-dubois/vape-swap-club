<?php 

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CoreController{

    public $router;

    /**
     * Method to add flash messages for success operations, or errors
     *
     * @param String $key BS Valu to choose between success or error
     * @param String $message message to display
     * @return void
     */
    protected static function addFlash($key, $message){
        $_SESSION['flashMessage'][$key][] = $message;
    }

    /**
     * Method to manage access for ACL and CSRF Tokens
     *
     * @param array $match
     * @param [type] $router
     */
    function __construct($match = [], $router){

        $this->router = $router;

        if($match == false){
            return;
        }
            $currentRoute = $match['name'];

            $acl = [

            ];

            // We check if the current route is a protected route

            if(array_key_exists($currentRoute, $acl)){
                // We get the ACL array for this route
                $authorizedRoles = $acl[$currentRoute];

                // And we call the method in charge of checking if current user has the good role
                $this->checkAuthorization($authorizedRoles);
            }

            // We check the routes which are protected by CSRF Token

            $csrfRoutes = [

            ];

            // We check the current route is a CSRF protected route
            if(in_array($currentRoute, $csrfRoutes)){
                // We get the token which was generated and stocked in session
                $tokenSession = (isset($_SESSION['csrfToken'])) ? $_SESSION['csrfToken'] : '';

                // We recover the token that must be sent with the form
                $formToken = filter_input(INPUT_POST, 'token');

                // If tokens are not the sames, or empty, we stop everything
                if(empty($tokenSession) || empty($formToken) || $formToken != $tokenSession){

                    // And then call error 403
                    $this->err403('Vous n\'avez pas les droits nécessaires afin d\'accéder à cette page');
                }
            }
        
        
    }

    protected function redirect($page){
        header('Location: '.$this->router->generate($page));
    }

    public function checkAuthorization($roles = []){
        // If user not connected, redirect to home
        if(!isset($_SESSION['userObject'])){
            self::addFlash(
                'danger',
                'Merci de vous connecter'
            );
            $this->redirect('main-home');
            exit;
        } else {
            // else we check the user role
            // starting by getting user's object
            $connectedUser = $_SESSION['userObject'];
            // and his role
            $userRole = $connectedUser->getRole();

            // If the user's role is not in the acl, display a 403 error
            // Unless the table of authorized roles is not empty.
            if(!in_array($userRole, $roles) && !empty($roles)) {
                $this->err403('Vous n\'avez pas les droits nécessaires afin d\'accéder à cette page');
            }
        }
    }

    /**
     * Method which send an email to the current User
     *
     * @param string $subject
     * @param string $body
     * @param string $recipient
     * @return bool
     */
    protected function sendmail($subject, $body, $recipient)
    {
        // The mail password is hide in the config.ini for gitignore
        $ini = parse_ini_file(__DIR__.'/../config.ini');

        // Config all email properties
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = 'ssl'; 
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;  
        $mail->Username = 'mcsnoos@gmail.com';
        $mail->Password = $ini['PWD_MAIL'];   
        $mail->IsHTML(true);
        $mail->From="mcsnoos@gmail.com";
        $mail->FromName="Vape Swap Club";
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($recipient);

        // Send and test if it works or not
        if($mail->Send()){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Method to display HTML code basing on views, and create Absolut Urls
     *
     * @param string $viewName Name of the file view
     * @param array $viewData Array to transmet to views
     * @return void
     */
    protected function show(string $viewName, $viewData = []){

        $router = $this->router;

        // Absolutes URLS

        $viewData['currentPage'] = $viewName;

        $viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';

        $viewData['uploadsUri'] = $_SERVER['BASE_URI'] . 'assets/uploads/';

        $viewData['baseUri'] = $_SERVER['BASE_URI'];

        extract($viewData);

        // $currentPage is now available for this value : $viewName

        // => $assetsBaseUri is now available for this value : $_SERVER['BASE_URI'] . '/assets/'

        // => $baseUri is now available for this value : $_SERVER['BASE_URI']

        // Mounting th full template of the page with header / body and footer
        require_once __DIR__.'/../views/layout/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/layout/footer.tpl.php';
    }


    protected function send(string $jsonData) {
        header("Content-Type:'application/json'");
        echo($jsonData);
    }

    public function err403($message){

        http_response_code(403);

        $this->show('error/error403',[
            'pageTitle' => 'Droits insuffisants',
            'message' => $message,
        ]);
        exit;
    }

}
