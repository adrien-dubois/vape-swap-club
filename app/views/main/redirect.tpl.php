
<div class="classic">
    <div class="redirect-elements">
        <p>Votre message a bien été envoyé</p> <br>
        <p>Vous allez être redirigé automatiquement dans </p><div id="counter-redirect"> 5</div> <br>
        <p class="fst-italic"> Ou cliquez directement <a href="<?= $this->router->generate('main-home') ?>">ici </a>...</p>
    </div>
</div>


<script>
    setInterval(function() {
        var div = document.querySelector("#counter-redirect");
        var count = div.textContent * 1 - 1;
        div.textContent = count;
        if (count <= 0) {
            window.location.replace("/");
        }
    }, 1000);
</script>