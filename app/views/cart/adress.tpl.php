<div class="container">
    <div class="row">

        <!-- ADRESS PART -->

        <div class="column-20 a-form">
            <div class="cont">
                <div class="titling">
                    <h3>Modifier l'adresse</h3>
                </div>
                <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>

                <!-- FORM -->
                <form action="" method="POST" autocomplete="off">

                    <!-- CSRF TOKEN -->
                    <input type="hidden" name="token" value="<?= $csrfToken; ?>">

                    <div class="user-details">

                        <!-- NAME -->
                        <div class="input-box">
                            <span class="detail">Nom complet</span>
                            <input name="name" type="text" placeholder="Entrez nom / prénom" value="<?= $adress->getName(); ?>" required>
                        </div>

                        <!-- PHONE -->
                        <div class="input-box">
                            <span class="detail">Tél. <i>(facultatif)</i> </span>
                            <input name="phone" type="tel" placeholder="Entrez votre numéro" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" value="<?= $adress->getPhone(); ?>">
                        </div>

                        <!-- STREET NUMBER -->
                        <div class="input-box">
                            <span class="detail">Numéro de rue</span>
                            <input id="street" type="number" name="number" value="<?= $adress->getNumber(); ?>" required>
                        </div>

                        <!-- ADRESS -->
                        <div class="input-box">
                            <span class="detail">Adresse</span>
                            <textarea type="text" name="adress" required> <?= $adress->getAdress(); ?> </textarea>
                        </div>

                        <!-- ZIP -->
                        <div class="input-box">
                            <span class="detail">Code Postal</span>
                            <input id="zip" type="number" name="zip" value="<?= $adress->getZip(); ?>" required>
                        </div>

                        <!-- CITY -->
                        <div class="input-box">
                            <span class="detail">Ville</span>
                            <input type="text" name="city" placeholder="Entrez votre ville" value="<?= $adress->getCity(); ?>" required>
                        </div>

                        <!-- MESSAGE -->
                        <div class="input-box">
                            <span class="detail">Message <i>(facultatif)</i> </span>
                            <textarea type="text" name="message"> <?= $adress->getMessage(); ?> </textarea>
                        </div>
                    </div>

                    <!-- SUBMIT -->
                    <div class="btn-adress">
                        <input class="btn-register" type="submit" value="Enregistrer">
                    </div>
                </form>
            </div>
        </div>

        <div class="column-20 side-img" style="margin-left: 20px;">
            <img src="<?= $assetsBaseUri ?>images/panda.png" class="right-img" alt=""> <!-- img -->
        </div>

    </div>
</div>