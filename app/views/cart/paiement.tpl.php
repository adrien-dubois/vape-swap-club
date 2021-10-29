<div class="small-container">
    <form method="post">
        <!-- ERROR MESSAGES FOR PAIEMENT -->
        <div id="errors"></div>
        <input type="text" id="cardholder-name" placeholder="Titulaire de la carte">
        
        <!-- CARD INFORMATION FORM -->
        <div id="card-elements"></div>
     
        <!-- ERRORS RELATIVE TO THE CARD -->
        <div id="card-errors"></div>
        <button id="card-button" type="button" data-secret="<?= $intent['client_secret'] ?>">Procéder au paiement</button>
    </form>
</div>