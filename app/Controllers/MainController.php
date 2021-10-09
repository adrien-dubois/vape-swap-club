<?php

namespace App\Controllers;


class MainController extends CoreController {


    /**
     * Method displaying homepage
     *
     * @return void
     */
    public function home(){

        $this->show('main/home', [
            'pageTitle' => 'Homepage',
        ]);
    }
}