<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('pk_test_51QUqzuPeVVVlfkjKz9HqDWhzeZIj65YWD1nZTy4ZK06bf1QfqEkPCoL3JepqRe9TYBwpfGUsbuEAHCULw3BjOSVo00j8amYK28'); 
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    const submitButton = document.getElementById('submit-button');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        submitButton.disabled = true;

        const {paymentMethod, error} = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
        });

        if (error) {
            alert(error.message);
            submitButton.disabled = false;
        } else {
            document.getElementById('payment-method').value = paymentMethod.id;
            form.submit();
        }
    });
</script>
