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
}