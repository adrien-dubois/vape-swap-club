<?php

namespace App\Controllers;

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
}