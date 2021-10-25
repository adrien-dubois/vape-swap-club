<?php

namespace App\Controllers;

use App\Models\AppUser;

class AppUserController extends CoreController{

    /**
     * Method which connect the user on the homepage
     *
     * @return void
     */
    public function connect()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $formIsValid = true;
        $errorList = [];

        if(empty($email)){
            $errorList[] = "Vous devez saisir votre email";
            $formIsValid = false;
        }

        if(empty($password)){
            $errorList[] = "Renseignez votre mot de passe";
            $formIsValid = false;
        }

        if($formIsValid === true){

            /**@var AppUser $newConnect */
            $newConnect = AppUser::findByEmail($email);

            if($newConnect === false){

                $errorList[] = "Email / Mot de passe incorrects";
                $formIsValid = false;

            } else {
                $userPass = $newConnect->getPassword();
                if (password_verify($password, $userPass)) {
                    $_SESSION['userObject'] = $newConnect;
                    $_SESSION['userId'] = $newConnect->getId();
                    $_SESSION['username'] = $newConnect->getFirstname() . ' ' . $newConnect->getLastname();

                    self::addFlash(
                        'success', 
                        'Connexion effectuée'
                    );
                    $data = ["Location" => $this->router->generate('main-home'), "formIsValid" => $formIsValid];
                }else{
                    $errorList[] = "E-Mail/Mot de passe incorrect";
                    $formIsValid = false;
                }
            }
        }

        if(!$formIsValid) {
            $data = ["errorList" => $errorList, "formIsValid" => $formIsValid];
        }
        $this->send(json_encode($data));
    }

   /**
    * Method to logout
    *
    * @return void
    */
    public function logout()
    {
        unset($_SESSION['userId']);
        unset($_SESSION['userObject']);
        unset($_SESSION['username']);

        $this->redirect('main-home');
    }

    /**
     * Method displaying the register form
     *
     * @return void
     */
    public function register(){

        $this->show('main/register', [
            'pageTitle' => 'S\'enregistrer',
        ]);

    }


    /**
     * Method to register a new account
     *
     * @return void
     */
    public function insert()
    {
        // We get the datas sended by form POST and sanitize it
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $pass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // Hashing right now the password
        $password = password_hash($pass,PASSWORD_DEFAULT);
        $role = 'Vaper';

        // creating variables and array to check and manage errors

        $formIsValid = true;
        $errorList = [];

        // Manage the avatar picture
        if(isset($_FILES['picture'])){
            $tmpName = $_FILES['picture']['tmp_name'];
            $name = $_FILES['picture']['name'];
            $error = $_FILES['picture']['error'];
            
            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));

            // var that authorized extensions
            $authorizedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if(in_array($extension, $authorizedExtensions) && $error == 0){

                $uniqueName = uniqid('', true);
                $pictureName = $uniqueName.'.'.$extension;

                move_uploaded_file($tmpName, __DIR__.'/../../public/assets/uploads/'.$pictureName);
            } else {
                self::addFlash(
                    'danger',
                    'Image non compatible'
                );
            }

        } else {
            $pictureName = 'nopic.png';
        }

        /*********************
         * Manage mistakes   *
         *********************/

        // Testing if fields are emptys

        if(empty($lastname)){
            $errorList[] = "Merci de renseigner votre nom de famille";
            $formIsValid = false;
        }

        if(empty($firstname)){
            $errorList[] = "Merci de renseigner votre prénom";
            $formIsValid = false;
        }

        if(empty($email)){
            $errorList[] = "Il faut saisir votre adresse mail";
            $formIsValid = false;
        }

        if (empty($password))
        {
            $errorList[] = 'Attention il faut définir un mot de passe';
            $formIsValid = false;
        }

        // Add regex for the password and test it
        if(preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $password)){
            $formIsValid = true;
        } else {
            $formIsValid = false;
            $errorList[] = 'Attention, votre mot de passe doit contenir au moins 8 caractères, une lettre en minuscule, une lettre en majuscule, ainsi qu\'un chiffre';
        }

        // INSERT IN DB

        // If all is OK, then we move to next step
        if($formIsValid === true){

            // We insert datas in the appropriate setters
            $newUser = new AppUser();
            $newUser->setLastname($lastname);
            $newUser->setFirstname($firstname);
            $newUser->setEmail($email);
            $newUser->setPassword($password);
            $newUser->setRole($role);
            $newUser->setPicture($pictureName);

            // If insert works great, then we redirect to homepage
            if($newUser->save()){
                self::addFlash(
                    'success',
                    'Votre inscription a bien été prise en compte !'
                );
                header('Location: ' . $this->router->generate('main-home'));
                exit;
            }
            // If we are here, there was a problem on the insertion, so we display it
            $errorList[] = "Une erreur s'est produite lors de la création de votre compte. Merci réessayer plus tard";
        }

        // We instanciate a new FOO to fill the fields with previous datas

        $user = new AppUser();
        $user->setLastname(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
        $user->setFirstname(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
        $user->setEmail(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));

        $this->show('main/register', [
            'pageTitle' => 'S\'enregistrer',
            'user'=>$user,
            'errorList'=>$errorList,
        ]);
    }
}