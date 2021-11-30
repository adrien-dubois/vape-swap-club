<?php

namespace App\Controllers;

class CategoryController extends CoreController{

    
    /**
     * Method which displays categories' list
     *
     * @return void
     */
    public function home() {


        $this->show('category/list',[
            'pageTitle' => 'Catégories',
        ]);
    }
}