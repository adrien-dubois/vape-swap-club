<div class="wrapper">
    <div class="left-profil">
        <!-- PICTURE -->
        <img src="<?= $uploadsUri . $profil->getPicture() ?>" width="100">
        <!-- USERNAME -->
        <h4><?= $_SESSION['username'] ?></h4>
        <!-- ROLE -->
        <p><?= $profil->getRole() ?></p>
    </div>

    <div class="right-profil">

        <!-- FIRST PART -->
        <div class="info-profil">
            <h3>Profil</h3>
            <div class="info-profil_data">

                <!-- CLUB NUMBER -->
                <div class="data">
                    <h4>Membre du Club N°</h4>
                    <p><?= $profil->getId() ?></p>
                </div>

                <!-- EMAIL -->
                <div class="data">
                    <h4>E-Mail</h4>
                    <p><?= $profil->getEmail() ?></p>
                </div>

            </div>
        </div>

        <!-- SECOND PART -->
        <div class="section-profil">
            <h3>Vos données</h3>
            <div class="section-profil_data">

                <!-- ADRESS -->
                <div class="data">
                    <h4>Adresse</h4>
                    <a href="#"><p>Votre adresse</p></a>
                </div>

                <!-- ORDERS -->
                <div class="data">
                    <h4>Vos commandes</h4>
                    <a href="#"><p>Liste de vos commandes</p></a>
                </div>

            </div>
        </div>
    </div>
</div>