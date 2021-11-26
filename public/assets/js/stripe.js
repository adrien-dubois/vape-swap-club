window.onload = () => {
    // variables
    let stripe = Stripe('pk_test_51JpySjKyQTIUNcxLn7kxOVC4R3BEa1yWEJx3oXYUHSo0yjk26yATyVsw4TfvFD0VVLPLxFRxtUlzhBl70yiPXVvq00c2N5C1tB');
    let redirect = "http://ec2-3-86-88-21.compute-1.amazonaws.com/cart/accept";
    
    // Page objects
    let cardHolderName = document.getElementById("cardholder-name");
    let cardButton = document.getElementById("card-button");
    let clientSecret = cardButton.dataset.secret;
    const options = {
        clientSecret: clientSecret,
    };
    const appearance = {
        theme: 'night',
    };
    const elements = stripe.elements({ clientSecret, appearance });
   


    // Create form elements for the credit card
    const payment = elements.create("payment");
    payment.mount("#payment-element");

    // Manage typing errors
    payment.addEventListener("change", (event)=>{
        let displayError = document.getElementById("card-errors")
        if(event.error){
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = "";
        }
    })

    // Manage payment
    cardButton.addEventListener("click", () => {
        stripe.confirmPayment({
            elements, 
            confirmParams:{
                return_url: '/cart/accept',
                payment_method_data: {
                        billing_details: {
                            name: cardHolderName.value
                        }
                }
            },
            
        }).then((result) => {
            if(result.error){
                document.getElementById("errors").innerText = result.error.message
            } else {
                document.location.href = redirect
            }
        })
    })

}