<?php

namespace App\Controllers;

use App\Models\AppUser;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Request;
use App\Models\Type;

class BackOfficeController extends CoreController{

    public function home(){

        $articles = Product::findCards();
        $nbProducts = Product::findNbProducts();
        $nbOrders = Order::findNbOrder();
        $nbUsers = AppUser::findNbUsers();
        $nbVendors = AppUser::findNbVendors();
        $vendors = AppUser::findAllForMessages();

        $this->show('backoffice/home', [
            'pageTitle' => 'Backoffice',
            'articles'  => $articles,
            'nbProducts'=> $nbProducts,
            'nbOrders'  => $nbOrders,
            'nbUsers'   => $nbUsers,
            'vendors'   => $vendors,
            'nbVendors' => $nbVendors,
        ]);
    }

    public function user(){

        $users = AppUser::findAll();

        $this->show('backoffice/user',[
            'pageTitle' => 'Utilisateurs',
            'users'     => $users
        ]);
    }

    public function products(){

        $products = Product::findAllForBackOffice();

        $this->show('backoffice/products',[
            'pageTitle' => 'Articles',
            'products'  => $products
        ]);
    }
    
    public function vendor(){

        $request = Request::findAll();

        $this->show('backoffice/request',[
            'pageTitle'  => 'Demande vendeur',
            'requests'   => $request,
            'csrfToken'  => $this->generateToken(),
        ]);
    }

    public function vendorValidate(){

        $userId = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
        $requestId = filter_input(INPUT_POST, 'request_id', FILTER_SANITIZE_NUMBER_INT);

        $errorList = [];

        $updateRole = AppUser::find($userId);
        $updateRole->setRole('Vendor');

        $updateRequest = Request::find($requestId);
        $updateRequest->setAccepted(2);

        if(($updateRequest->update()) && ($updateRole->update())){

            self::addFlash(
                'success',
                'Requête de vendeur validée'
            );
        } else {

            $errorList[] = 'Une erreur s\'est produite, merci d\'essayer plus tard.';
        }

        $request = Request::findAll();

        $this->show('backoffice/request',[
            'pageTitle'  => 'Demande vendeur',
            'requests'   => $request,
            'errorList'  => $errorList,
        ]);

    }

    public function editProduct($id){

        $currentProduct = Product::find($id);

        $allTypes = Type::findAll();
        $allCategories = Category::findAll();
        $allBrands = Brand::findAll();

        $this->show('backoffice/edit-product',[
            'pageTitle'      => 'Éditer un article',
            'allTypes'       => $allTypes,
            'allCategories'  => $allCategories,
            'allBrands'      => $allBrands,
            'currentProduct' => $currentProduct,
            'csrfToken'      => $this->generateToken(),
        ]);
    }

    public function updateProduct($id){

        $update = Product::find($id);

        // Take datas posted and sanitize it
        $productName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $subtitle = filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);
        $rate = filter_input(INPUT_POST, 'rate', FILTER_SANITIZE_NUMBER_INT);
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);
        $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT);
        $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_NUMBER_INT);

        $app_user_id = $_SESSION['userId'];

        // Variables to manage errors
        $formIsValid = true;
        $errorList = [];

        // Manage the main thumbnail picture
        if(isset($_FILES['picture']) && !empty($_FILES['picture']['name'])) {
            $tmpName = $_FILES['picture']['tmp_name'];
            $name = $_FILES['picture']['name'];
            $error = $_FILES['picture']['error'];

            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));

            // var that authorized extensions
            $authorizedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($extension, $authorizedExtensions) && $error == 0) {

                $uniqueName = uniqid('IMG-', true);
                $pictureName = $uniqueName . '.' . $extension;

                move_uploaded_file($tmpName, __DIR__ . '/../../public/assets/uploads/' . $pictureName);
            } else {
                self::addFlash(
                    'danger',
                    'Image non compatible'
                );
            }
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

        if($formIsValid === true){

            if(isset($pictureName)){
                $update->setPicture($pictureName);
            }

            $update->setName($productName);
            $update->setDescription($description);
            $update->setSubtitle($subtitle);
            $update->setPrice($price);
            $update->setRate($rate);
            $update->setCategory_id($category);
            $update->setTypeId($type);
            $update->setBrandId($brand);
            $update->setApp_user_id($app_user_id);

            if($update->update()){

                self::addFlash(
                    'success',
                    'L\'article a bien été mis à jour'
                );

                header('Location: ' . $this->router->generate('backoffice-products'));
                exit;
            } else {
                $errorList[] = "Une erreur s'est produite lors de la mise à jour, merci réessayer plus tard";
            }
        }

        $product = new Product();
        $product->setName(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
        $product->setDescription(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
        $product->setSubtitle(filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING));
        $product->setPrice((float) filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT));
        $product->setRate((int) filter_input(INPUT_POST, 'rate', FILTER_SANITIZE_NUMBER_INT));
        $product->setCategory_id((int) filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT));
        $product->setTypeId((int) filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT));
        $product->setBrandId((int) filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_NUMBER_INT));

        // Re-fill all selects in case of error
        $allTypes = Type::findAll();
        $allCategories = Category::findAll();
        $allBrands = Brand::findAll();

        $this->show('backoffice/edit-product',[
            'pageTitle'      => 'Éditer un article',
            'allTypes'       => $allTypes,
            'allCategories'  => $allCategories,
            'allBrands'      => $allBrands,
            'currentProduct' => $product,
            'errorList'      => $errorList,
        ]);
    }
}