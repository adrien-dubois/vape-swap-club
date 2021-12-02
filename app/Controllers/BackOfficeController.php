<?php

namespace App\Controllers;

class BackOfficeController extends CoreController{

    public function home(){

        $this->show('backoffice/home', [
            'pageTitle' => 'Backoffice'
        ]);
    }
}