<div class="container">
    <div class="row">
        <div class="mail-box">
            <div class="contact-box">
                
                    <a class="btn-return-mailbox" href="<?= $this->router->generate('msg-home') ?>" >
                            < Retour
                    </a>
                
                <div class="titler"><?= $recipientName ?></div>

                <div class="chat-window" id="msgScroll">
                    <?php if ($number > $totalNbMessages) : ?>
                        <button id="seeMore" class="btn-seeMoreMsg">
                            Voir plus
                        </button>

                    <?php
                    endif; ?>
                    <div id="loadMore"></div>

                    <!-- EXTRACT ALL MESSAGES -->
                    <?php
                    foreach ($conversation as $message) :
                    ?>
                        <!-- AND FOR EACH MESSAGE SELECT WHO'S TALKING -->

                        <!-- FOR MYSELF -->
                        <?php if ($message->getSender_id() ==  $_SESSION['userId']) : ?>

                            <div class="myself-message">
                                <?= nl2br($message->getMessage()); ?>
                            </div>

                            <!-- FOR MY INTERLOCUTOR -->
                        <?php else : ?>

                            <div class="user-message">
                                <?= nl2br($message->getMessage()); ?>
                            </div>

                        <?php endif; ?>
                    <?php endforeach; ?>
                    <div id="display"></div>
                    <div id="load-messages"></div>
                </div>

                <!-- SEND MESSAGE PART -->
                <div class="sendChatBox" style="margin-top: 20px;">
                    <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>
                    <form action="" method="post" id="chat">

                            <!-- CHAT BOX -->   
                                <textarea rows="1" data-min-rows="1" name="message" id="chatbox" placeholder="Votre message..." class="textareaChat" style="border: none; overflow: none; resize: none; width: 90%; outline: none; padding: 0 5px"></textarea>
                            
                            <!-- SUBMIT -->
                            <div class="btn-sendChat">
                                <input type="submit" name="send" class="fa fa-arrow-circle-up" value="&#xf0aa;" style="border: none; background: transparent; outline: none; cursor: pointer; color: grey; font-size: 24px;"/>
                            </div>
                            
                    </form>



                </div>

            </div>
        </div>
    </div>
</div>


<!-- JS PART FOR DISPLAYING MESSAGES WITHOUT REFRESH -->

<script>
    $(document).ready(function() {

        document.getElementById('msgScroll').scrollTop = document.getElementById('msgScroll').scrollHeight;

        $('#chat').on("submit", function(e) {
            e.preventDefault();

            var id;
            var message;

            id = <?= json_encode($recipientId, JSON_UNESCAPED_UNICODE); ?>;
            message = document.getElementById('chatbox').value;

            document.getElementById('chatbox').value = '';

            if (id > 0 && message != '') {
                $.ajax({
                    url: '/messages/chat',
                    method: 'POST',
                    dataType: 'html',
                    data: {
                        id: id,
                        message: message
                    },

                    success: function(data) {
                        $('#display').append(data);
                        document.getElementById('msgScroll').scrollTop = document.getElementById('msgScroll').scrollHeight;
                    },

                    error: function(e, xhr, s) {
                        let error = e.responseJSON;
                        if (e.status == 403 && typeof error !== 'undefined') {
                            alert('Action non autorisée');
                        } else if (e.status == 403) {
                            alert('Action non autorisée');
                        } else if (e.status == 401) {
                            alert('Veuillez vous re-authentifier');
                        } else if (e.status == 404) {
                            alert('La page demandée n\'est pas disponible');
                        } else {
                            alert('Erreur');
                        }
                    }
                });
            }
        });

        var auto_loading_messages = 0;

        auto_loading_messages = clearInterval(auto_loading_messages);

        auto_loading_messages = setInterval(autoLoadMessage, 2000);

        function autoLoadMessage() {

            var id = <?= json_encode($recipientId, JSON_UNESCAPED_UNICODE); ?>;

            if (id > 0) {
                $.ajax({
                    url: '/messages/load/chat',
                    method: 'POST',
                    dataType: 'html',
                    data: {
                        id: id,
                    },

                    success: function(data) {
                        if (data.trim() != '') {
                            $('#load-messages').append(data);
                            document.getElementById('msgScroll').scrollTop = document.getElementById('msgScroll').scrollHeight;
                        }
                    },

                    error: function(e, xhr, s) {
                        let error = e.responseJSON;
                        if (e.status == 403 && typeof error !== 'undefined') {
                            alert('Action non autorisée');
                        } else if (e.status == 403) {
                            alert('Action non autorisée');
                        } else if (e.status == 401) {
                            alert('Veuillez vous re-authentifier');
                        } else if (e.status == 404) {
                            alert('La page demandée n\'est pas disponible');
                        } else {
                            alert('Erreur');
                        }
                    }
                });
            }
        }

        <?php if ($number > $totalNbMessages) : ?>

            var req = 0;

            $('#seeMore').click(function() {
                var id;
                var element;

                req += <?= $totalNbMessages ?>;
                id = <?= json_encode($recipientId, JSON_UNESCAPED_UNICODE); ?>;

                $.ajax({
                    url: '/messages/load/more',
                    method: 'POST',
                    dataType: 'html',
                    data: {
                        limit: req,
                        id: id,
                    },

                    success: function(data) {
                        $(data).hide().appendTo('#loadMore').fadeIn(2000);
                        document.getElementById('loadMore').removeAttribute('id');
                    },

                    error: function(e, xhr, s) {
                        let error = e.responseJSON;
                        if (e.status == 403 && typeof error !== 'undefined') {
                            alert('Action non autorisée');
                        } else if (e.status == 403) {
                            alert('Action non autorisée');
                        } else if (e.status == 401) {
                            alert('Veuillez vous re-authentifier');
                        } else if (e.status == 404) {
                            alert('La page demandée n\'est pas disponible');
                        } else {
                            alert('Erreur');
                        }
                    }
                });

            });

        <?php endif; ?>

    });
</script>