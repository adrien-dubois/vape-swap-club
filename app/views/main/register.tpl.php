<div class="container-register">
    <div class="r-form">
        <div class="heading">
            <h1>Créer un compte</h1>
        </div>

        <!-- FORM -->
        <form action="" method="post" enctype="multipart/form-data" class="user-form">
            <div class="wrap">
                <div class="f1">
                    <label class="label">Nom</label>
                    <input class="input" name="lastname" type="text"/>
                    <span class="focus-input"></span>
                </div>
                <div class="f2">
                    <label class="label">Prénom</label>
                    <input class="input" name="firstname" type="text"/>
                    <span class="focus-input"></span>
                </div>
            </div>
            <div class="wrap2">
                <label class="label">E-Mail</label>
                <input class="input" name="email" type="text">
                <span class="focus-input2"></span>
            </div>
            <div class="wrap2">
                <label class="label">Mot de passe</label>
                <input class="input" name="password" type="password">
                <span class="focus-input2"></span>
            </div>
            <div class="wrap2">
                <label class="label">Avatar</label>
                <input class="input" name="picture" type="file">
                <span class="focus-input2"></span>
            </div>

            <button class="btn-register" type="submit">Enregistrer</button>
        </form>
    </div>

    <!-- IMAGE -->
    <div class="side-img"> <!--image-->
        <img src="<?= $assetsBaseUri ?>images/register2.png" class="right-img" alt=""> <!-- img -->
    </div>
</div>
