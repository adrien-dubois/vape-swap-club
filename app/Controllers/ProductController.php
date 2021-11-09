<?php

namespace App\Controllers;

use App\Controllers\CoreController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;

class ProductController extends CoreController{

    /**
     * Method to display all products list with pagination to have 8 products per page
     *
     * @return void
     */
    public function list()
    {
        // Setup the pagination & the current page
        if(isset($_GET['page']) && !empty($_GET['page'])){
            $thisPage = (int) strip_tags($_GET['page']);
        } else {
            $thisPage = 1;
        }
        
        // Number of products per pages
        $perPage = 8;
        
        // Get the number of products for the pagination
        $productModel = new Product();
        $nbProducts = $productModel->findNbProducts();

        // Calculate the number of pages
        /**@var int $nbProducts */
        $nbPages = ceil($nbProducts / $perPage);
        
        // Calculate first product of the page
        $first = ($thisPage * $perPage) - $perPage;
        
        // Get the products in DB that are calculated for the pagination
        $allProducts = $productModel->findAllForList($first, $perPage);

        $allBrands = Brand::findAll();

        $this->show('product/list',[
            'pageTitle' => 'Annonces',
            'products'=>$allProducts,
            'brands'=>$allBrands,
            'nbPages'=>$nbPages,
            'thisPage'=>$thisPage,
        ]);
    }

    /**
     * Display a single product and add to cart
     *
     * @param int $id
     * @return void
     */
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

    /**
     * Display an adding product page
     *
     * @return void
     */
    public function add()
    {

        $allBrands = Brand::findAll();
        $allTypes = Type::findAll();
        $allCategories = Category::findAll();

        $this-> show('product/add', [
            'pageTitle' => 'Ajouter une annonce',
            'allBrands' => $allBrands,
            'allTypes' => $allTypes,
            'allCategories' => $allCategories,
            'product' => new Product(),
        ]);
    }
}