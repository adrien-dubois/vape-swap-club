<div class="container" style="text-align: center;">
    <h1 style="text-transform: uppercase; color: #FC833C; font-weight: bold;">403 Non autorisé</h1>
    <br>
    <p>
        <?= $message ?>
    </p>
    <br>
    <a href="<?= $this->router->generate('main-home') ?>" style="color: grey;">Retour à l'accueil</a>
</div>