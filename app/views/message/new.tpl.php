<div class="container">
    <div class="row">
        <div class="mail-box">
            <div class="contact-box">

                <!-- TITLE -->
                <div class="titler">Nouveau message</div>
                <form action="" method="post">
                    <div class="contact-details">

                        <!-- USERS -->
                        <div class="msg-box">
                            <span class="msg-details">Contact</span>
                            <select name="contact" class="input2" required>
                                <option disabled selected>Choisir un contact</option>
                                <?php foreach($contacts as $currentContact): ?>
                                    <option value="<?= $currentContact->getId() ?>"> <?= $currentContact->getFirstname() . ' ' . $currentContact->getLastname() ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- TITLE -->
                        <div class="msg-box">
                            <span class="msg-details">Titre du message</span>
                            <input type="text" placeholder="Titre" name="title" required>
                        </div>

                        <!-- MESSAGE -->
                        <div class="msg-box">
                            <span class="msg-details">Message</span>
                            <textarea name="message" cols="30" rows="10" placeholder="Votre message..." required></textarea>
                        </div>

                        <!-- SUBMIT -->
                        <div class="btn-adress">
                            <input type="submit" class="btn-register" value="Valider">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>