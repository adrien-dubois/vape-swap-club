<?php

namespace App\Controllers;

use App\Models\AppUser;
use App\Models\Message;

class MsgController extends CoreController
{

    /**
     * Display homepage of messages
     *
     * @return void
     */
    public function home()
    {
        $receivedMessages = Message::findLastMessageMailbox();
        $contacts = AppUser::findAllForMessages();
        $currentUser = $_SESSION['userObject'];

        $this->show('message/main', [
            'pageTitle' => 'Messagerie',
            'receivedMessages' => $receivedMessages,
            'contacts' => $contacts,
            'currentUser' =>$currentUser,
        ]);
    }

    public function redirectConversation(){

        $receivedMessages = Message::findLastMessageMailbox();
        $contacts = AppUser::findAllForMessages();

        $recipientId = filter_input(INPUT_POST, 'recipientId', FILTER_SANITIZE_NUMBER_INT);

        if(!empty($recipientId)){
            header('Location: ' . $this->router->generate('msg-read', ['recipientId'=>$recipientId]));
            exit;
        }

        $this->show('message/main', [
            'pageTitle' => 'Messagerie',
            'receivedMessages' => $receivedMessages,
            'contacts' => $contacts,
        ]);
    }

    /**
     * Display form to write and send a new message
     *
     * @return void
     */
    public function new()
    {

        $contacts = AppUser::findAllForMessages();

        $this->show('message/new', [
            'pageTitle' => 'Nouveau message',
            'contacts' => $contacts,

        ]);
    }

    /**
     * Posting a new message & store it in DB
     *
     * @return void
     */
    public function sendNew()
    {

        // Store datas & sanitize it
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
        $recipient_id = filter_input(INPUT_POST, 'recipientId', FILTER_SANITIZE_NUMBER_INT);
        $sender_id = $_SESSION['userId'];

        // Variables to manage errors
        $formIsValid = true;
        $errorList = [];

        // Testing if fields are emptys

        if (empty($title)) {
            $errorList[] = "Vous devez donner un titre à votre message";
            $formIsValid = false;
        }

        if (empty($message)) {
            $errorList[] = "Vous devez écrire un message";
            $formIsValid = false;
        }

        if (empty($recipient_id)) {
            $errorList[] = "Vous devez sélectionner un destinataire";
            $formIsValid = false;
        }

        // INSERT IN DB

        // If all is OK, then we move to next step

        if ($formIsValid === true) {

            $newMessage = new Message();
            $newMessage->setTitle($title);
            $newMessage->setMessage($message);
            $newMessage->setRecipient_id($recipient_id);
            $newMessage->setSender_id($sender_id);

            if ($newMessage->save()) {

                // Prepare email to inform the recipient
                $recipientModel = AppUser::find($recipient_id);
                $recipient = $recipientModel->getEmail();
                $subject = 'Vous avez reçu un message privé - Vape Swap Club';
                $body = '
                <h2>Vous avez reçu un message privé</h2>

                <p>Bonjour ' . $recipientModel->getFirstname()  . ', vous venez de recevoir un message privé de la part de ' . $_SESSION['username'] . ' afin de démarrer une discussion avec vous. <br> Pour pouvoir le lire et prendre part à la discussion, veuillez vous connecter à votre compte sur <strong>Vape Swap Club</strong> </p>
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

        $this->show('message/new', [
            'pageTitle' => 'Nouveau message',
            'contacts' => $contacts,
            'errorList' => $errorList,
        ]);
    }

    /**
     * Display the page of the new discuss
     *
     * @param [type] $recipientId
     * @return void
     */
    public function read(int $recipientId)
    {

        $conversation = Message::findMessageConversation($recipientId);
        $recipient = AppUser::find($recipientId);
        $recipientName = $recipient->getFirstname() . ' ' . $recipient->getLastname();

        $sender_id = $_SESSION['userId'];

        $totalNbMessages = 15;
        $checkNbMessages = 0;
        $nbMessages = Message::nbMessages($recipientId);
        $number = $nbMessages[0]->NbMessages;

        // TODO
        $updateMessage = new Message();
        $updateMessage->setSender_id($recipientId);
        $updateMessage->setRecipient_id($sender_id);
        $updateMessage->setIs_read(1);
        $updateMessage->update();

        $this->show('message/read', [
            'pageTitle' => 'Messages',
            'conversation' => $conversation,
            'recipientId' => $recipientId,
            'recipientName' => $recipientName,
            'totalNbMessages' => $totalNbMessages,
            'number' => $number,
        ]);
    }

    /**
     * Method to send message the static way, without refreshing page
     *
     * @param int $recipientId
     * @return void
     */
    public function sendStatic($recipientId)
    {

        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
        $sender_id = $_SESSION['userId'];

        // Variables to manage errors
        $formIsValid = true;
        $errorList = [];

        // Testing if fields are emptys

        if (empty($message)) {
            $errorList[] = "Vous devez écrire un message";
            $formIsValid = false;
        }

        // INSERT IN DB

        // If all is OK, then we move to next step

        if ($formIsValid === true) {

            $newMessage = new Message();
            $newMessage->setMessage($message);
            $newMessage->setRecipient_id($recipientId);
            $newMessage->setSender_id($sender_id);

            $newMessage->save();
        }

        $conversation = Message::findMessageConversation($recipientId);

        $this->show('message/read', [
            'pageTitle' => 'Messages',
            'conversation' => $conversation,
            'recipientId' => $recipientId
        ]);
    }

    /**
     * Method which manage Ajax function to display messages without refresh
     *
     * @return void
     */
    public function chat()
    {

        $recipient_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $message = urldecode(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING));
        $sender_id = $_SESSION['userId'];

        if ($recipient_id <= 0 || empty($message)) {
            exit;
        }

        $newMessage = new Message();
        $newMessage->setSender_id($sender_id);
        $newMessage->setRecipient_id($recipient_id);
        $newMessage->setMessage($message);

        $newMessage->save();

        // Adding NL2BR in the case of the user of the chat send message with line breaks
        echo ('<div class="myself-message">' .
            nl2br($message)
            . ' </div>');
    }

    /**
     * Load messages without refresh with upload to set if message is read
     *
     * @return void
     */
    public function loadChat()
    {

        $sender_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $recipient_id = $_SESSION['userId'];

        if ($sender_id <= 0) {
            exit;
        }

        $messages = Message::findMessageAutoload($sender_id);

        $updateMessage = new Message();
        $updateMessage->setSender_id($sender_id);
        $updateMessage->setRecipient_id($recipient_id);
        $updateMessage->setIs_read(1);
        $updateMessage->update();


        foreach ($messages as $currentMessage) {
            echo ('<div class="user-message">' .
                nl2br($currentMessage->getMessage())
                . '</div>');
        }
    }

    /**
     * Load more messages
     *
     * @return void
     */
    public function loadMore()
    {

        $limit = filter_input(INPUT_POST, 'limit', FILTER_SANITIZE_NUMBER_INT);
        $recipientId = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        if ($limit <= 0 || $recipientId <= 0) {
            exit;
        }

        $totalNbMessages = 15;

        $minLimit = 0;
        $maxLimit = 0;

        $checkNbMessages = 0;
        $nbMessages = Message::nbMessages($recipientId);
        $number = $nbMessages[0]->NbMessages;

        $minLimit = $number - $limit;

        if ($minLimit > $totalNbMessages) {
            $maxLimit = $totalNbMessages;
            $minLimit = $minLimit - $totalNbMessages;
        } else {
            if ($minLimit > 0) {
                $maxLimit = $minLimit;
            } else {
                $maxLimit = 0;
            }
            $minLimit = 0;
        }

        $conversation = Message::findLimitConversation($recipientId, $minLimit, $maxLimit);

        if ($minLimit <= 0) {
            echo ("
                <div>
                    <script>
                        var elem = document.getElementById('seeMore');
                        elem.classList.add('btn-hide-seeMoreMsg');
                    </script>
                </div>
            ");
        }
        echo ("
             <div id='loadMore'></div>
        ");

        foreach ($conversation as $message) {
            if ($message->getSender_id() == $_SESSION['userId']) {
                echo ('
                <div class="myself-message">
                    ' .  nl2br($message->getMessage()) . '
                </div>
                ');
            } else {
                echo ('
                <div class="user-message">
                    ' . nl2br($message->getMessage()) . '
                </div>
                ');
            }
        }
    }

    /**
     * Delete an entire conversation between 2 persons
     *
     * @param int $recipient_id
     * @return void
     */
    public function deleteConversation($recipient_id){

        $deleteValid = true;
        $conversation = Message::findAllMessagesConversation($recipient_id);

        foreach($conversation as $message){

            $delete = $message->deleteConversation();
            if ($delete) {
                $deleteValid = true;
            } else{
                $deleteValid = false;
            }
        }

        if($deleteValid === true){
            self::addFlash(
                'danger',
                'La conversation a bien été supprimée'
            );
    
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
        
    }
}
