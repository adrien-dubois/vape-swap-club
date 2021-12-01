<div class="container-form">
    <div class="vendor-form">
        <div class="vendor-info">
            <h3 class="vendor-title">Devenir vendeur</h3>
            <p class="vendor-text">Pour pouvoir rejoindre notre équipe de vendeur et ainsi poster des annonces, merci de remplir le formulaire ci-contre. Soyez sûr de pouvoir justifier de l'authenticité de vos articles. Vous recevrez un message afin de vous confirmer votre nouveau statut.</p>

            <div class="infos-container">

                <div class="info-vendeur">
                    <i class="fas fa-map-marked-alt"></i>
                    <p>Renseignez vos informations postales</p>
                </div>

                <div class="info-vendeur">
                <i class="fas fa-phone-alt"></i>
                    <p>Ainsi que votre téléphone, en cas de besoin</p>
                </div>

                <div class="info-vendeur">
                <i class="fas fa-certificate"></i>
                    <p>Et surtout ayez vos certificats d'authenticité afin de justifier du caractère original de vos produits</p>
                </div>

            </div>
        </div>

        <div class="contact-vendor">

            <form method="post" class="formulaire">
                <h3 class="vendor-title">Infos vendeur</h3>

                <?php require __DIR__ . '/../partials/_errors.tpl.php' ; ?>


                <!-- FULL NAME -->
                <div class="input-container-vendor">
                    <input type="text" name="name" class="input-vendor" value="<?= $request->getName() ?>" required>
                    <label for="" class="vendor-label">Nom complet</label>
                    <span>Nom complet</span>
                </div>

                <!-- EMAIL -->
                <div class="input-container-vendor">
                    <input type="text" name="email" class="input-vendor" value="<?= $request->getEmail() ?>" required>
                    <label for="" class="vendor-label">E-Mail</label>
                    <span>E-Mail</span>
                </div>

                <!-- PHONE -->
                <div class="input-container-vendor">
                    <input type="tel" name="phone" class="input-vendor" value="<?= $request->getTelephone() ?>" required>
                    <label for="" class="vendor-label">Téléphone</label>
                    <span>Téléphone</span>
                </div>

                <!-- ADRESS -->
                <div class="input-container-vendor textarea">
                    <textarea name="adress" class="input-vendor"><?= $request->getAdress() ?></textarea>
                    <label for="" class="vendor-label">Adresse complète</label>
                    <span>Adresse complète</span>
                </div>

                <!-- APP USER -->
                <input type="text" value="<?= $_SESSION['userId'] ?>" name="app_user_id" hidden>

                <!-- SUBMIT -->
                <input type="submit" value="Envoyer" class="btn-vendor">

            </form>
        </div>
    </div>
</div>

<script>

const inputs = document.querySelectorAll(".input-vendor");

function focusFunc(){
    let parent = this.parentNode;
    parent.classList.add("focus");
}

function blurFunc(){
    let parent = this.parentNode;
    if(this.value == ""){
        parent.classList.remove("focus");
    }
}

inputs.forEach((input) => {
    input.addEventListener("focus", focusFunc);
    input.addEventListener("blur", blurFunc);
});
</script>