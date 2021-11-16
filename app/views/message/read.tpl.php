<div class="container">
    <div class="row">
        <div class="mail-box">
            <div class="contact-box">
                <div class="titler">Conversation</div>

                <?php foreach ($conversation as $message) : ?>

                    <!-- FOR MYSELF -->
                    <?php if ($message->getSender_id() ==  $_SESSION['userId']) : ?>
                        <div style="background: #212121; color: grey;">
                            <?= $message->getMessage(); ?>
                        </div>

                        <!-- FOR INTERLOCUTOR -->
                    <?php else : ?>
                        <div>
                            <?= $message->getMessage(); ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                <!-- SEND MESSAGE PART -->
                <div style="margin-top: 20px;;">
                    <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>
                    <form action="" method="post">
                        <div class="contact-details">

                            <!-- CHAT BOX -->
                            <div class="msg-box">
                                <span class="msg-details">Réponse: </span>
                                <textarea name="message" id="chatbox" placeholder="Votre message..." required></textarea>
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