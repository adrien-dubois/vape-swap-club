<?php

namespace App\Controllers;

use App\Controllers\CoreController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;

class ProductController extends CoreController
{

    /**
     * Method to display all products list with pagination to have 8 products per page
     *
     * @return void
     */
    public function list()
    {
        // Setup the pagination & the current page
        if (isset($_GET['page']) && !empty($_GET['page'])) {
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

        $this->show('product/list', [
            'pageTitle' => 'Annonces',
            'products' => $allProducts,
            'brands' => $allBrands,
            'nbPages' => $nbPages,
            'thisPage' => $thisPage,
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
     * Display the first adding a new product page
     *
     * @return void
     */
    public function add()
    {

        $allTypes = Type::findAll();
        $allCategories = Category::findAll();
        $allBrands = Brand::findAll();

        $this->show('product/add', [
            'pageTitle' => 'Ajouter une annonce',
            'allTypes' => $allTypes,
            'allCategories' => $allCategories,
            'allBrands' => $allBrands,
            'product' => new Product(),
        ]);
    }

    /**
     * Register the first part of new product
     *
     * @return void
     */
    public function insert()
    {
        // Take datas posted and sanitize it
        $productName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $subtitle = filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);
        $rate = filter_input(INPUT_POST, 'rate', FILTER_SANITIZE_NUMBER_INT);
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);
        $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT);
        $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_NUMBER_INT);
        $newBrand = filter_input(INPUT_POST, 'new-brand', FILTER_SANITIZE_STRING);

        // Variables to manage errors
        $formIsValid = true;
        $errorList = [];

        // Manage the main thumbnail picture
        if (isset($_FILES['picture'])) {
            $tmpName = $_FILES['picture']['tmp_name'];
            $name = $_FILES['picture']['name'];
            $error = $_FILES['picture']['error'];

            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));

            // var that authorized extensions
            $authorizedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($extension, $authorizedExtensions) && $error == 0) {

                $uniqueName = uniqid('', true);
                $pictureName = $uniqueName . '.' . $extension;

                move_uploaded_file($tmpName, __DIR__ . '/../../public/assets/uploads/' . $pictureName);
            } else {
                self::addFlash(
                    'danger',
                    'Image non compatible'
                );
            }
        } else {
            $errorList[] = "Veuillez mettre une photo de votre article";
            $formIsValid = false;
        }

        /*********************
         * Manage mistakes   *
         *********************/

        // Testing if fields are emptys
        
        if(empty($productName)){
            $errorList[] = "Merci de renseigner le nom de l'article";
            $formIsValid = false;
        }
        
        if(empty($description)){
            $errorList[] = "Merci de renseigner la description";
            $formIsValid = false;
        }
        
        if(empty($subtitle)){
            $errorList[] = "Merci de renseigner le résumé";
            $formIsValid = false;
        }
        
        if($price < 0){
            $errorList[] = "Merci de saisir le prix";
            $formIsValid = false;
        }
        
        if(empty($rate)){
            $errorList[] = "Merci de noter votre produit";
            $formIsValid = false;
        }
        
        if(empty($category)){
            $errorList[] = "Choisissez une catégorie";
            $formIsValid = false;
        }
        
        if(empty($type)){
            $errorList[] = "Séléctionnez un type de produit";
            $formIsValid = false;
        }

        // INSERT IN DB

        // If all is OK, then we move to next step

        if($formIsValid === true){

            // We insert datas in apporpriate setters and create a new product FOO

            $newProduct = new Product();
            $newProduct->setName($productName);
            $newProduct->setDescription($description);
            $newProduct->setSubtitle($subtitle);
            $newProduct->setPrice($price);
            $newProduct->setRate($rate);
            $newProduct->setCategory_id($category);
            $newProduct->setTypeId($type);
            $newProduct->setPicture($pictureName);

            // If a new brand is created
            if(!isset($brand) && isset($newBrand)){
                $addBrand = new Brand();
                $addBrand->setName($newBrand);
                if( $addBrand -> save()){
                    $newBrandId = $addBrand->getId();
                    $newProduct->setBrandId($newBrandId);
                    if($newProduct->save()){

                        self::addFlash(
                            'success',
                            'Votre produit a bien été enregistré'
                        );
                        header('Location: ' . $this->router->generate('product-adding'));
                        exit;
                    }
                }
            
            // If brand is select in the list
            } elseif(isset($brand)){
                $newProduct->setBrandId($brand);
                if($newProduct->save()){

                    self::addFlash(
                        'success',
                        'Votre produit a bien été enregistré'
                    );
                    header('Location: ' . $this->router->generate('product-adding'));
                    exit;
                }
            }

            $errorList[] = "Une erreur s'est produite lors de la création, merci réessayer plus tard";

        }

        $product = new Product();
        $product->setName(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
        $product->setDescription(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
        $product->setSubtitle(filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING));
        $product->setPrice((float) filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT));
        $product->setRate((int) filter_input(INPUT_POST, 'rate', FILTER_SANITIZE_NUMBER_INT));
        $product->setCategory_id((int) filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING));
        $product->setTypeId((int) filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING));

        // Re-fill all selects in case of error
        $allTypes = Type::findAll();
        $allCategories = Category::findAll();
        $allBrands = Brand::findAll();

        $this->show('product/add', [
            'pageTitle' => 'Ajouter une annonce',
            'allTypes' => $allTypes,
            'allCategories' => $allCategories,
            'allBrands' => $allBrands,
            'product' => $product,
            'errorList' => $errorList,
        ]);
    }

    /**
     * Displaying the second part of adding a new product
     *
     * @return void
     */
    public function adding()
    {



        $this->show('product/adding', [
            'pageTitle' => 'Ajouterune annonce',

            'product' => new Product(),
        ]);
    }
}
