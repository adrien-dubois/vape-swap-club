<?php 

namespace App\Controllers;

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

        if(!empty($match)){
            $currentRoute = $match['name'];

            $acl = [

            ];

            // We check if the current route is a protected route

            if(isset($acl[$currentRoute])){
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
                    $errorController = new ErrorController;
                    // And then call error 403
                    $errorController->err403;
                }
            }
        }
        
    }

    protected function redirect($page){
        header('Location: '.$this->router->generate($page));
    }

    public function checkAuthorization($roles = []){
        // If user not connected, redirect to home
        if(!isset($_SESSION['connectedUser'])){
            $this->redirect('user-login');
        } else {
            // else we check the user role
            // starting by getting user's object
            $connectedUser = $_SESSION['connectedUser'];
            // and his role
            $userRole = $connectedUser->getRole();

            // If the user's role is not in the acl, display a 403 error
            // Unless the table of authorized roles is not empty.
            if(!in_array($userRole, $roles) && !empty($roles)) {
                $errorController = new ErrorController;
                $errorController->err403();
            }
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

        $viewData['baseUri'] = $_SERVER['BASE_URI'];

        extract($viewData);

        // $currentPage is now available for this value : $viewName

        // => $assetsBaseUri is now available for this value : $_SERVER['BASE_URI'] . '/assets/'

        // => $baseUri is now available for this value : $_SERVER['BASE_URI']

        require_once __DIR__.'/../views/layout/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/layout/footer.tpl.php';
    }


    protected function send(string $jsonData) {
        header("Content-Type :'application/json'");
        echo($jsonData);
    }

}