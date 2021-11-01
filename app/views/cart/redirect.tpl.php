
<div class="r-form">
    <p>Votre paiement a été accepté</p>
    <p>Vous allez être redirigé automatiquement dans </p><div id="counter">5</div>
    <a href="http://localhost:8080/"><p class="fst-italic">Ou cliquez directement ici ...</p></a>
</div>


<script>
    setInterval(function() {
        var div = document.querySelector("#counter");
        var count = div.textContent * 1 - 1;
        div.textContent = count;
        if (count <= 0) {
            window.location.replace("http://localhost:8080/")
        }
    }, 1000);
</script>