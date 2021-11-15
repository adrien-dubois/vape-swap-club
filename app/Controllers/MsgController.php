<?php

namespace App\Controllers;

use App\Models\AppUser;
use App\Models\Message;

class MsgController extends CoreController{

    /**
     * Display homepage of messages
     *
     * @return void
     */
    public function home(){

        $receivedMessages = Message::findAllMessageReceived();

        $this->show('message/main',[
            'pageTitle' => 'Messagerie',
            'receivedMessages' => $receivedMessages,
        ]);
    }

    /**
     * Display form to write and send a new message
     *
     * @return void
     */
    public function new(){

        $contacts = AppUser::findAllForMessages();

        $this->show('message/new',[
            'pageTitle' => 'Nouveau message',
            'contacts' => $contacts,

        ]);
    }

    /**
     * Posting a new message & store it in DB
     *
     * @return void
     */
    public function sendNew(){
        
        // Store datas & sanitize it
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
        $recipient_id = filter_input(INPUT_POST, 'recipientId', FILTER_SANITIZE_NUMBER_INT);
        $sender_id = $_SESSION['userId'];

        // Variables to manage errors
        $formIsValid = true;
        $errorList = [];

        // Testing if fields are emptys

        if(empty($title)){
            $errorList[] = "Vous devez donner un titre à votre message";
            $formIsValid = false;
        }

        if(empty($message)){
            $errorList[] = "Vous devez écrire un message";
            $formIsValid = false;
        }

        if(empty($recipient_id)){
            $errorList[] = "Vous devez sélectionner un destinataire";
            $formIsValid = false;
        }

        // INSERT IN DB

        // If all is OK, then we move to next step

        if ($formIsValid === true) {

            $newMessage = new Message();
            $newMessage -> setTitle($title);
            $newMessage -> setMessage($message);
            $newMessage -> setRecipient_id($recipient_id);
            $newMessage -> setSender_id($sender_id);

            if($newMessage -> save()){

                // Prepare email to inform the recipient
                $recipientModel = AppUser::find($recipient_id);
                $recipient = $recipientModel->getEmail();
                $subject = 'Vous avez reçu un message privé - Vape Swap Club';
                $body = '
                <h2>Vous avez reçu un message privé</h2>

                <p>Bonjour ' . $recipientModel->getFirstname()  . ', vous venez de recevoir un message privé de la part de '. $_SESSION['username'] .' <br> Afin de pouvoir le lire la discussion, veuillez vous connecter à votre compte sur <strong>Vape Swap Club</strong> </p>
                <br>
                <p>Merci de votre confiance, bonne vape, </p>
                <p><i>Vape Swap Club</i></p>
                ';

                // Send mail
                $this->sendmail($subject, $body, $recipient);

                self::addFlash(
                    'success',
                    'Votre message privé a bien été envoyé'
                );
                header('Location: ' . $this->router->generate('msg-home'));
                exit;
            }
            $errorList[] = "Une erreur s'est produite lors de l'envoi du message, merci réessayer plus tard";
        }

        $message = new Message();
        $message->setTitle(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
        $message->setMessage(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING));

        $contacts = AppUser::findAllForMessages();

        $this->show('message/new',[
            'pageTitle' => 'Nouveau message',
            'contacts' => $contacts,
            'errorList' => $errorList,
        ]);
    }

    public function read($recipientId){

        $conversation = Message::findMessageConversation($recipientId);

        // dd($conversation);

        $this->show('message/read',[
            'pageTitle' => 'Messages',
            'conversation' => $conversation,
        ]);
    }
}