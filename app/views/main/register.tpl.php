<div class="container-register">
    <div class="r-form">
        <div class="heading">
            <h1>Créer un compte</h1>
        </div>
       <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>

        <!-- FORM -->
        <form action="" method="POST" enctype="multipart/form-data" class="user-form">
            <div class="wrap">
                <!-- LASTNAME -->
                <div class="f1">
                    <label class="label">Nom</label>
                    <input class="input" name="lastname" type="text" value="<?php if (isset($user)) : echo $user->getLastname(); endif; ?>"/>
                    <span class="focus-input"></span>
                </div>

                <!-- FIRSTNAME -->
                <div class="f2">
                    <label class="label">Prénom</label>
                    <input class="input" name="firstname" type="text" value="<?php if (isset($user)) : echo $user->getFirstname(); endif; ?>"/>
                    <span class="focus-input"></span>
                </div>
            </div>

            <!-- EMAIL -->
            <div class="wrap2">
                <label class="label">E-Mail</label>
                <input class="input" name="email" type="text" value="<?php if (isset($user)) : echo $user->getEmail(); endif; ?>"/>
                <span class="focus-input2"></span>
            </div>

            <!-- PASSWORD -->
            <div class="wrap2">
                <label class="label">Mot de passe</label>
                <input class="input" name="password" type="password">
                <span class="focus-input2"></span>
            </div>

            <!-- AVATAR -->
            <div class="wrap2">
                <label class="label">Avatar</label>
                <input class="input" name="picture" type="file">
                <span class="focus-input2"></span>
            </div>

            <button class="btn-register" type="submit">Enregistrer</button>
        </form>
    </div>

    <!-- SIDE FORM IMAGE -->
    <div class="side-img"> <!--image-->
        <img src="<?= $assetsBaseUri ?>images/register2.png" class="right-img" alt=""> <!-- img -->
    </div>
</div>
