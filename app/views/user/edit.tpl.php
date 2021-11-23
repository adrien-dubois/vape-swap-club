<div class="profil-card">
    <div class="profil-title">
        <h3>Mon profil</h3>
    </div>
    <a class="btn-return-mailbox" href="<?= $this->router->generate('user-show') ?>" >
        < Retour
    </a>
    <div class="image-container">
        <img src="<?= $uploadsUri . $profil->getPicture(); ?>" width="100%">
    </div>


    <div class="profil-form">
        <div class="cont">
            <form autocomplete="off" method="post" enctype="multipart/form-data">
                <div class="user-details">

                    <!--  LASTNAME -->
                    <div class="input-box">
                        <span class="detail">Nom</span>
                        <input name="lastname" type="text" placeholder="Nom..." value="<?= $user->getLastname() ?>" >
                    </div>

                    <!--  FIRSTNAME -->
                    <div class="input-box">
                        <span class="detail">Prénom</span>
                        <input name="firstname" value="<?= $user->getFirstname() ?>" type="text" placeholder="Prénom..." >
                    </div>

                    <!--  PASSWORD -->
                    <div class="input-box">
                        <span class="detail">Mot de passe</span>
                        <input name="password" type="password" placeholder="Mot de passe..." >
                    </div>

                    <!--  PASSWORD CONFIRM -->
                    <div class="input-box">
                        <span class="detail">Confirmation</span>
                        <input name="confirm" type="password" placeholder="Mot de passe..." >
                    </div>
                    <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>
                    <small style="color: grey;">Minimum 8 caractères / 1 Majuscule / 1 chiffre</small>

                    <!--  EMAIL -->
                    <div class="input-box">
                        <span class="detail">E-Mail</span>
                        <input name="email" value="<?= $user->getEmail() ?>" type="text" placeholder="E-Mail..." >
                    </div>

                     <!-- PICTURE -->
                    
                    <div class="input-box">
                        <input class="input-profil-pic" type="file" name="picture" id="profil-picture">
                        <label for="profil-picture"<i class="fas fa-edit"></i><span>Changer</span> </label>
                    </div>

                    <script>
                        var inputs = document.querySelectorAll('.input-profil-pic');
                        Array.prototype.forEach.call(inputs, function(input) {
                            var label = input.nextElementSibling,
                                labelVal = label.innerHTML;

                            input.addEventListener('change', function(e) {
                                var fileName = 'OK';

                                if (fileName)
                                    label.querySelector('span').innerHTML = fileName;
                                else
                                    label.innerHTML = labelVal;
                            });
                        });
                    </script>

                    
                    <input type="submit" class="btn-primary" value="Valider">
                    

                </div>
            </form>
        </div>
    </div>
</div>