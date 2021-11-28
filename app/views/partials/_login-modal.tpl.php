    <!-- LOGIN MODAL -->
    <div class="bg-modal">
        <div class="modal-content">
            <div class="close">+</div>
            <span style="font-size: 64px; color: #FC833C;">
                <i class="fas fa-user-circle"></i>
            </span>

            <div class="l-form">
                <form action="/" id="form" name="form" class="form">
                    <h1 class="form__title">Connexion</h1>
                    <div class="form__div">
                        <input type="text" placeholder=" " id="email" name="email" class="form__input">
                        <label for="" class="form__label">Email</label>
                    </div>
                    
                    <div class="form__div">
                        <input type="password" placeholder=" " id="password" name="password" class="form__input">
                        <label for="" class="form__label">Mot de passe</label>
                    </div>
                    <div id="errors"></div>

                    <small><i><a href="<?= $this->router->generate('main-register') ?>" style="color: #fff">Pas encore inscrit(e)? Cliquez ici</a></i></small>

                    <input type="submit" id="submit" class="btn-register" style="text-align: center;" value="Connexion">
                    
                </form>


            </div>
        </div>
    </div>