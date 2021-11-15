<div class="container">
    <div class="row">
        <div class="mail-box">
            <div class="contact-box">
                <div class="titler">Conversation</div>

                <?php foreach ($conversation as $message) : ?>
                    <?php if ($message->getSender_id() ==  $_SESSION['userId']) : ?>
                        <div style="background: #212121; color: grey;">
                            <?= $message->getMessage(); ?>
                        </div>
                    <?php else : ?>
                        <div>
                            <?= $message->getMessage(); ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                <div style="margin-top: 20px;">
                        <form action="" method="post">
                            <textarea name="message" placeholder="Votre message...."></textarea>
                            <input type="submit" name="send" value="Envoyer">
                        </form>
                </div>

            </div>
        </div>
    </div>
</div>