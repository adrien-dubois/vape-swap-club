<div class="profil-card">
    <div class="image-container">
        <img src="<?= $uploadsUri . $profil->getPicture(); ?>" width="100%">
    </div>
    <h2 style="text-align: center;"><?= $_SESSION['username'] ?></h2>
    <div class="main-container">

        <a class="btn-edit-profile" href="<?= $this->router->generate('user-edit') ?>"><i class="fas fa-edit"></i>Éditer le profil</a>
        <p><i class="fas fa-award profil-info"></i><span>Membre du Club n° </span><?= $profil->getId() ?></p>
        <p><i class="far fa-id-badge profil-info"></i><span>Status </span><?= $profil->getRole() ?></p>
        <p><i class="far fa-envelope profil-info"></i><span>E-Mail </span><?= $profil->getEmail() ?></p>
        <br>
        <hr>
        <p style="text-align: center; margin: 1rem 0;"><b><i class="fas fa-info profil-info"></i><span>Informations :</span></b></p>

        <a href="#"> 
            Adresse de livraison
        </a>
        <br>
        <a href="#">
            Commandes passées
        </a>
    </div>
</div>