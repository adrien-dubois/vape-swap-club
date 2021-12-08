<section class="contact-form">
    <div class="contact-content">
        <h2>Formulaire de contact</h2>
        <p>Si vous souhaitez contacter l'équipe de <b>Vape Swap Club</b>, vous pouvez le faire via le formulaire de contact présent sur cette page, après avoir renseigné vos informations. 
        <br>
        <br>
        N'oubliez pas que pour contacter un vendeur, vous avez la messagerie privée à votre disposition, à partir de votre menu personnel.</p>
    </div>
    <div class="contact-container">
        <div class="contact-info">

            <div class="contact-boxs">
                <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                <div class="contact-text">
                    <h3>Adresse</h3>
                    <p>42 rue du dev, <br> 42000 Code City</p>
                </div>
            </div>

            <div class="contact-boxs">
                <div class="contact-icon"><i class="fas fa-mobile-alt"></i></div>
                <div class="contact-text">
                    <h3>Téléphone</h3>
                    <p>+33 742 424 424</p>
                </div>
            </div>

            <div class="contact-boxs">
                <div class="contact-icon"><i class="far fa-envelope"></i></div>
                <div class="contact-text">
                    <h3>Email</h3>
                    <p>adrien-dubois@white-umbrella.fr</p>
                </div>
            </div>
        </div>

        <div class="contactForm">
            <form action="" method="post">
                <h2>Envoyer un message</h2>
                <?php require __DIR__ . '/../partials/_errors.tpl.php' ?>

                <input type="hidden" name="token" value="<?= $csrfToken; ?>">

                <!-- FULL NAME -->
                <div class="contact-inputBox">
                    <input type="text" name="name" required>
                    <span>Nom complet</span>
                </div>

                <!-- EMAIL -->
                <div class="contact-inputBox">
                    <input type="text" name="email" required>
                    <span>E-Mail</span>
                </div>

                <!-- MESSAGE -->
                <div class="contact-inputBox">
                    <textarea name="message" required="required"></textarea>
                    <span>Votre message...</span>
                </div>

                <!-- SUBMIT -->
                <div class="contact-inputBox">
                    <input type="submit" value="Envoyer">
                </div>
                
            </form>
        </div>
    </div>
</section>