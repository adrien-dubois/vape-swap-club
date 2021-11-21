<div class="container-profil" style="position: relative;">
    <div class="profil-card">
        <div class="image-container">
            <img src="<?= $uploadsUri . $profil->getPicture(); ?>" width="100%">
        </div>
        <h2 style="text-align: center;"><?= $_SESSION['username'] ?></h2>
        <div class="main-container">

            <a class="btn-edit-profile" href="<?= $this->router->generate('user-edit') ?>"><i class="fas fa-edit"></i>Éditer le profil</a>
            <p><i class="fas fa-award profil-info"></i><span>Membre du Club n°</span> <?= $profil->getId() ?></p>
            <p><i class="far fa-id-badge profil-info"></i><span>Status</span> <?= $profil->getRole() ?></p>
            <p><i class="far fa-envelope profil-info"></i><span>E-Mail</span> <?= $profil->getEmail() ?></p>
            <br>
            <hr>
            <p style="text-align: center; margin: 1rem 0;"><b><i class="fas fa-info profil-info"></i><span>Informations :</span></b></p>

            <!-- CHECKBOXES TO MAKES SWITCHES ON CSS -->
            <form action="">
                
                <div>
                    <input type="checkbox" name="adress" id="adr" class="switch">
                    <label for="adr">Adresse de livraison</label>
                </div>
                
                <br>
                <div>
                    <input type="checkbox" name="order" id="ord" class="switch">
                    <label for="ord">Commandes passées</label>
                </div>
            </form>
        </div>
    </div>

    <div class="containeur-profil">
        <div class="card-member">
            <div class="left-column background1-left-column">
                <h6>Carte de membre</h6>
                <h2>Vape Swap Club</h2>
                <img src="<?= $assetsBaseUri; ?>images/logo.png" width="120px">
            </div>

            <div class="right-column">
                <div>
                    <h4>Membre n°<?= $_SESSION['userId'] ?></h4>
                    <h6><?= $_SESSION['username'] ?></h6>
                </div>

                <h2>Adresse de livraison</h2>
                <?php if(!empty($adress)): ?>
                    <p><?= $adress->getName() ?></p>
                    <p><?= $adress->getNumber() . ' ' . $adress->getAdress() ?></p>
                    <p><?= $adress->getZip() . ' ' . $adress->getCity() ?></p>
                    <?php if (!empty($adress->getPhone())) : ?>
                        <p>Téléphone : <?= $adress->getPhone() ?></p>
                    <?php endif; ?>
                <?php else : ?>
                    <p style="margin: auto;">Vous n'avez pas encore renseigné d'adresse de livraison</p>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    var adress = document.getElementById('adr');
    adress.addEventListener('change', function(){
        if(adress.checked){
        document.querySelector('.containeur-profil').style.display = 'flex';
    } else {
        document.querySelector('.containeur-profil').style.display ='none';
    }
});
</script>
