<?php

namespace App\Controllers;

use App\Controllers\CoreController;
use App\Models\Brand;
use App\Models\Category;
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
        $allBrands = Brand::findAll();

        // Get the number of products for the pagination
        $productModel = new Product();
        $nbProducts = $productModel->findNbProducts();

        $this->show('product/list',[
            'pageTitle' => 'Annonces',
            'products'=>$allProducts,
            'brands'=>$allBrands,
            'nbProducts'=>$nbProducts,
        ]);
    }

    public function single($id)
    {
        $product = Product::find($id);
        $relatedBrand = $product->getBrandId();
        $relatedCategory = $product->getCategory_id();

        $brandModel = new Brand();
        $brand = $brandModel->find($relatedBrand);

        $categoryModel = new Category();
        $category = $categoryModel->find($relatedCategory);

        $this->show('product/single', [
            'pageTitle' => 'Annonce',
            'product' => $product,
            'brand' => $brand,
            'category' => $category
        ]);
    }
}