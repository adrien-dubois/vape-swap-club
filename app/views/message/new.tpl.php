<div class="container">
    <div class="row">
        <div class="mail-box">
            <div class="contact-box">

                <!-- TITLE -->
                <div class="titler">Nouveau message</div>
                <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>
                <form action="" method="post">
                    <div class="contact-details">

                        <!-- USERS -->
                        <div class="msg-box">
                            <span class="msg-details">Destinataire</span>
                            <select name="recipientId" class="input2" required>
                                <option disabled selected>Choisir un contact</option>
                                <?php foreach($contacts as $currentContact): ?>
                                    <option value="<?= $currentContact->getId() ?>"> <?= $currentContact->getFirstname() . ' ' . $currentContact->getLastname() ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- TITLE -->
                        <div class="msg-box">
                            <span class="msg-details">Titre du message</span>
                            <input type="text" placeholder="Titre..." name="title" required>
                        </div>

                        <!-- MESSAGE -->
                        <div class="msg-box">
                            <span class="msg-details">Message</span>
                            <textarea name="message" cols="30" rows="10" placeholder="Votre message..." required></textarea>
                        </div>

                        <!-- SUBMIT -->
                        <div class="btn-adress">
                            <button type="submit" name="upload" class="btn-register"> Envoyer </button>
                        </div>
                        <div class="btn-adress">
                            <a href="<?= $this->router->generate('msg-home'); ?>"> <button style="cursor: pointer;" class="btn-modify">Retour</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>