window.onload = () => {
    // variables
    let stripe = Stripe('pk_test_51JpySjKyQTIUNcxLn7kxOVC4R3BEa1yWEJx3oXYUHSo0yjk26yATyVsw4TfvFD0VVLPLxFRxtUlzhBl70yiPXVvq00c2N5C1tB');
    let elements = stripe.elements();
    let redirect = "/";

    // Page objects
    let cardHolderName = document.getElementById("cardholder-name");
    let cardButton = document.getElementById("card-button");
    let clientSecret = cardButton.dataset.secret;

    // Create form elements for the credit card
    let card = elements.create("card");
    card.mount('#card-elements');

    // Manage typing errors
    card.addEventListener("change", (event)=>{
        let displayError = document.getElementById("card-errors")
        if(event.error){
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = "";
        }
    })

    // Manage paiement
    cardButton.addEventListener("click", () => {
        stripe.handleCardPayment(
            clientSecret, card, {
                payment_method_data: {
                    billing_details: {name: cardHolderName.value}
                }
            }
        ).then((result) => {
            if(result.error){
                document.getElementById("errors").innerText = result.error.message
            } else {
                document.location.href = redirect
            }
        })
    })

}