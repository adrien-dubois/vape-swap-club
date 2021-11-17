<div class="container">
    <div class="row">
        <div class="mail-box">
            <div class="contact-box">
                <div class="titler"><?= $recipientName ?></div>

                <div class="chat-window" id="msgScroll">
                    <?php if ($number > $totalNbMessages) : ?>
                        <button id="seeMore">
                            Voir plus
                        </button>
                    <?php
                    endif; ?>
                    <div id="loadMore"></div>
                    <?php
                    foreach ($conversation as $message) :
                    ?>

                        <!-- FOR MYSELF -->
                        <?php if ($message->getSender_id() ==  $_SESSION['userId']) : ?>
                            <div style="background: #212121; color: grey;">
                                <?= nl2br($message->getMessage()); ?>
                            </div>

                            <!-- FOR INTERLOCUTOR -->
                        <?php else : ?>
                            <div>
                                <?= nl2br($message->getMessage()); ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <div id="display"></div>
                    <div id="load-messages"></div>
                </div>

                <!-- SEND MESSAGE PART -->
                <div style="margin-top: 20px;;">
                    <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>
                    <form action="" method="post" id="chat">
                        <div class="contact-details">

                            <!-- CHAT BOX -->
                            <div class="msg-box">
                                <span class="msg-details">Réponse: </span>
                                <textarea name="message" id="chatbox" placeholder="Votre message..."></textarea>
                            </div>

                            <!-- SUBMIT -->
                            <div>
                                <button type="submit" name="send" class="btn-primary" style="margin: inherit;">Envoyer</button>
                            </div>
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

            $('#seeMore').click(function(){
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