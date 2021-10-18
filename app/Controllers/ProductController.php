<?php

namespace App\Controllers;

use App\Controllers\CoreController;
use App\Models\Product;

class ProductController extends CoreController{

    public function list()
    {
        $allProducts = Product::findAll();

        $this->show('product/list',[
            'pageTitle' => 'Annonces',
            'productList'=>$allProducts
        ]);
    }
}