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

        if($match == false){
            return;
        }
        $routeName = $match['name'];
        
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


}