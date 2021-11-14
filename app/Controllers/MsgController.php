<?php

namespace App\Controllers;

use App\Models\AppUser;

class MsgController extends CoreController{

    /**
     * Display homepage of messages
     *
     * @return void
     */
    public function home(){

        $this->show('message/main',[
            'pageTitle' => 'Messagerie',
        ]);
    }

    public function new(){

        $contacts = AppUser::findAllMessages();

        $this->show('message/new',[
            'pageTitle' => 'Nouveau message',
            'contacts' => $contacts,

        ]);
    }

    public function sendNew(){
        
    }
}