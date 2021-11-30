
<div class="classic">
    <div class="redirect-elements">
        <p>Votre paiement a été accepté</p> <br>
        <p>Vous allez être redirigé automatiquement dans </p><div id="counter"> 5</div> <br>
        <p class="fst-italic"> Ou cliquez directement <a href="http://ec2-3-86-88-21.compute-1.amazonaws.com/">ici</a> ...</p>
    </div>
</div>


<script>
    setInterval(function() {
        var div = document.querySelector("#counter");
        var count = div.textContent * 1 - 1;
        div.textContent = count;
        if (count <= 0) {
            window.location.replace("http://ec2-3-86-88-21.compute-1.amazonaws.com/")
        }
    }, 1000);
</script>