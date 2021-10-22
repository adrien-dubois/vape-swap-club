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

        $productCarousel = new Product();
        $carousel = $productCarousel->findAll();

        $this->show('main/home', [
            'pageTitle' => 'Accueil',
            'carousel' => $carousel,
        ]);
    }
}