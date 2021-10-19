<?php

namespace App\Controllers;

use App\Controllers\CoreController;
use App\Models\Product;

class ProductController extends CoreController{

    /**
     * Method to display all products
     *
     * @return void
     */
    public function list()
    {
        $allProducts = Product::findAll();

        $this->show('product/list',[
            'pageTitle' => 'Annonces',
            'productList'=>$allProducts
        ]);
    }

    public function single($id)
    {
        $product = Product::find($id);

        $this->show('product/single', [
            'pageTitle' => 'Annonce',
            'product' => $product
        ]);
    }
}