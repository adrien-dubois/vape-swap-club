<?php
if(isset($_SESSION['userObject'])){
    $currentUser = $_SESSION['userObject'];
}
?>
<div class="stripe-container">
    <form method="post" class="stripe-form">
        <!-- ERROR MESSAGES FOR PAIEMENT -->
        <div id="errors"></div>
        <div class="wrap2">
            <label class="label">Titulaire de la carte</label>
            <input type="text" id="cardholder-name" class="input">
            <span class="focus-input2"></span>
        </div>
        
        <!-- CARD INFORMATION FORM -->
        <div id="payment-element">
            <!-- Mount the Payment Element here -->
        </div>
     
        <!-- ERRORS RELATIVE TO THE CARD -->
        <div id="card-errors" role="alert"></div>
        <button id="card-button" class="btn-primary" type="button" data-secret="<?= $intent['client_secret'] ?>">Procéder au paiement</button>
    </form>
</div>