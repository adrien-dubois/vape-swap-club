<div class="profil-card">
    <div class="image-container">
        <img src="<?= $uploadsUri . $profil->getPicture(); ?>" width="100%">
        <div class="image-title">
            <a href=""><p><i class="far fa-edit"></i>Changer</p></a>
        </div>
    </div>
    <h2 style="text-align: center;"><?= $_SESSION['username'] ?></h2>
    <div class="main-container">

        <p><i class="fas fa-award profil-info"></i><span>Membre du Club n° </span><?= $profil->getId() ?></p>
        <p><i class="far fa-id-badge profil-info"></i><span>Status </span><?= $profil->getRole() ?></p>
        <p><i class="far fa-envelope profil-info"></i><span>E-Mail </span><?= $profil->getEmail() ?></p>
        
    </div>
</div>