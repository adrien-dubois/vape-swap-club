<?php

namespace App\Controllers;

class ErrorController extends CoreController{

    public function err404(){

        header('HTTP/1.0 404 Not Found');

        $this->show('error/error404', [
            'pageTitle'=>'Page non trouvée'
        ]);
    }

    public function err403(){
        http_response_code(403);
        $this->show('error/error403');
        exit;
    }
}