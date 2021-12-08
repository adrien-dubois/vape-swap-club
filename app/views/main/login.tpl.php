<div class="container">
    <div class="row">
        <div class="login-content" style="margin: 3rem auto;">
            <span style="font-size: 64px; color: #FC833C;">
                <i class="fas fa-user-circle"></i>
            </span>
            <div class="l-form">
                <form action="" method="POST" name="form" class="form">
                    <h1 class="form__title">Connexion</h1>
                    <?php require __DIR__ . '/../partials/_errors.tpl.php'; ?>


                    <!-- EMAIL -->
                    <div class="form__div">
                        <input type="text" placeholder=" " name="email" class="form__input">
                        <label for="" class="form__label">Email</label>
                    </div>

                    <!-- PASSWORD -->
                    <div class="form__div">
                        <input type="password" placeholder=" " name="password" class="form__input">
                        <label for="" class="form__label">Mot de passe</label>
                    </div>

                    <!-- REGISTER LINK -->
                    <small><i><a href="<?= $this->router->generate('main-register') ?>" style="color: #fff">Pas encore inscrit(e)? Cliquez ici</a></i></small>

                    <!-- SUBMIT -->
                    <input type="submit" class="btn-login" style="text-align: center;" value="Connexion">

                </form>


            </div>
        </div>
    </div>
</div>