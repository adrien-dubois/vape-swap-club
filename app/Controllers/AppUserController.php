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
                    $_SESSION['username'] = $newConnect->getFirstname();

                    // self::addFlash(
                    //     'success', 
                    //     'Connexion effectuée'
                    // );
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

    public function logout()
    {
        unset($_SESSION['userId']);
        unset($_SESSION['userObject']);
        unset($_SESSION['username']);

        $this->redirect('main-home');
    }
}