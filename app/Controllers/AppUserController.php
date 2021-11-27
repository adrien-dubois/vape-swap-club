<?php

namespace App\Controllers;

use App\Models\Adress;
use App\Models\AppUser;
use App\Models\Order;

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
                $userCode = $newConnect->getActivation_code();
                $userStatus = $newConnect->getStatus();
                if($userStatus === "not verified"){
                    self::addFlash(
                        'danger',
                        'Vous devez activer votre compte'
                    );
                    $data = ["Location" => 'register/otp?code=' . $userCode, "formIsValid" => $formIsValid];
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

        self::addFlash(
            'danger',
            'Déconnecté'
        );
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

        $role = 'Vaper';
        $activation_code = md5(rand());
        $otp = rand(100000, 999999);
        $status = 'not verified';

        // creating variables and array to check and manage errors

        $formIsValid = true;
        $errorList = [];

        // Manage the avatar picture
        if(isset($_FILES['picture']) && !empty($_FILES['picture']['name'])){
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

        } elseif(empty($_FILES['picture']['name'])){
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

        if (empty($pass))
        {
            $errorList[] = 'Attention il faut définir un mot de passe';
            $formIsValid = false;
        }

        // Add regex for the password and test it
        if(preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $pass)){
            $formIsValid = true;
            // Hashing right now the password
            $password = password_hash($pass,PASSWORD_DEFAULT);
        } elseif(!preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $pass)) {
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
            $newUser->setActivation_code($activation_code);
            $newUser->setOtp($otp);
            $newUser->setStatus($status);

            // If insert works great, then we redirect to homepage
            if($newUser->save()){

                // Preparing email for OTP
                $recipient = $email;
                $subject = 'Code de confirmation d\'inscription - Vape Swap Club';
                $body = '
                    <p>Afin de vérifier votre adresse mail pour votre inscription sur Vape Swap Club, entrez ce code de vérification : <b>'.$otp.'</b>.</p>
                    <p>Merci de votre confiance, bonne vape, </p>
                    <p><i>Vape Swap Club</i></p>
                ';

                $mailer = $this->sendmail($subject, $body, $recipient);

                if($mailer === true){
                    self::addFlash(
                        'success',
                        'Code de vérification envoyé par mail'
                    );
                    header('Location: register/otp?code=' . $activation_code);
                    exit;
                } else {
                    self::addFlash(
                        'danger',
                        'L\'email de confirmation n\'a pû être envoyé, essayez plus tard'
                    );
                }

            } else{
                // If we are here, there was a problem on the insertion, so we display it
                $errorList[] = "Une erreur s'est produite lors de la création de votre compte. Merci réessayer plus tard";
            }
        }

        // We instanciate a new FOO to fill the fields with previous datas

        $user = new AppUser();
        $user->setLastname(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
        $user->setFirstname(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
        $user->setEmail(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));

        $this->show('main/register', [
            'pageTitle' => 'S\'enregistrer',
            'user'      =>$user,
            'errorList' =>$errorList,
        ]);
    }

    /**
     * Display activation code page
     *
     * @return void
     */
    public function otp(){

        $this->show('main/otp', [
            'pageTitle' => 'Confirmation d\'inscription'
        ]);
    }

    /**
     * Method to change the statut to activate user
     *
     * @return void
     */
    public function activation(){

        // declare variables
        $errorList = [];
        $userActivationCode = '';
        $user = new AppUser();

        if(isset($_GET["code"])){

            $userActivationCode = $_GET["code"];

                if(isset($_POST["submit"]))
                {
                   
                    if(empty($_POST["user_otp"]))
                    {
                        $errorList[] = 'Veuillez saisir votre code d\'activation';
                    }
                    else 
                    {
                        $otp = $_POST["user_otp"];
                        $user->findUserActivationCode($userActivationCode, $otp);
            
                        if($user === false)
                        {
                            $errorList[] = 'Numéro d\'activation invalide';
                        } 
                        else 
                        { 
                            // dd('coucou');
                            $activate = new AppUser();
                            $activate->activateUser($userActivationCode);
            
                            self::addFlash(
                                'success',
                                'Votre compte a bien été activé'
                            );
            
                            header('Location: ' . $this->router->generate('main-home'));
                            exit;
                        }
                    }
                }
        } 

        $this->show('main/otp', [
            'pageTitle' => 'Confirmation d\'inscription',
            'errorList' => $errorList,
        ]);
    }


    public function showProfile(){

        $adress = Adress::findByUser($_SESSION['userId']);
        $orders = Order::findOwnerOrder($_SESSION['userId']);
        $profil = AppUser::find($_SESSION['userId']);

        $this->show('user/profil',[
            'pageTitle' => 'Profil',
            'profil'    => $profil,
            'adress'    => $adress,
            'orders'    => $orders,
        ]);
    }

    public function editProfile(){

        $id = $_SESSION['userId'];
        $user = AppUser::find($id);

        $this->show('user/edit',[
            'pageTitle' => 'Éditer profil',
            'profil'    => $_SESSION['userObject'],
            'user' => $user,
        ]);
    }

    public function updateProfil(){

        // dd($_POST, $_FILES);

        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $confirm = filter_input(INPUT_POST, 'confirm', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        $id = $_SESSION['userId'];
        $update = AppUser::find($id);
        $formIsValid = true;
        $errorList = [];

        if(!empty($password)){
            if ($password != $confirm) {
                $formIsValid = false;
                $errorList[] = 'Les mots de passes ne sont pas identiques';
            } elseif ($password == $confirm) {
                if (preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $password)) {
                    $formIsValid = true;
                    // Hashing now the password
                    $pass = password_hash($password, PASSWORD_DEFAULT);
                } else {
                    $formIsValid = false;
                    $errorList[] = 'Attention, votre mot de passe doit contenir au moins 8 caractères, une lettre en minuscule, une lettre en majuscule, ainsi qu\'un chiffre';
                }
            }
        }

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

        if($formIsValid === true){

            if(isset($pass)){
                $update->setPassword($pass);
            }

            if(isset($pictureName)){
                $update->setPicture($pictureName);
            }

            $update->setFirstname($firstname);
            $update->setLastname($lastname);
            $update->setEmail($email);
           
            

            if($update->update()){

                self::addFlash(
                    'success',
                    'Votre profil a bien été modifié'
                );

                header('Location: ' . $this->router->generate('user-show'));
                exit;
            }
        }
        
        $user = new AppUser();

        $user->setLastname(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
        $user->setFirstname(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
        $user->setEmail(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));

        $this->show('user/edit',[
            'pageTitle' => 'Éditer profil',
            'profil'    => $_SESSION['userObject'],
            'errorList' => $errorList,
            'user' => $user,
        ]);
    }
}