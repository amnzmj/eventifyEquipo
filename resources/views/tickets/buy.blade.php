@extends('layouts.app')

@section('title', 'Comprar Boletos')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Comprar Boletos para {{ $event->name }}</h1>
        <p class="text-center"><strong>Precio:</strong> ${{ $event->price }}</p>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('events.buy', $event->id) }}" id="payment-form">
            @csrf
            <input type="hidden" name="payment_method" id="payment-method">
            
            <div class="mb-3">
                <label for="quantity" class="form-label">Cantidad de boletos:</label>
                <input type="number" class="form-control" name="quantity" id="quantity" min="1" max="10" required> 
            </div>

            <div class="mb-3">
                <label for="card-element" class="form-label">Información de la tarjeta:</label>
                <div id="card-element" class="form-control"></div>
            </div>

            <button type="submit" id="submit-button" class="btn btn-primary w-100">Comprar</button>
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            // Configurar Stripe con la clave pública
            const stripe = Stripe('{{ env('STRIPE_KEY') }}'); // Usa STRIPE_PUBLIC o STRIPE_KEY dependiendo de tu configuración
            const elements = stripe.elements();
            const card = elements.create('card');
            card.mount('#card-element');

            const form = document.getElementById('payment-form');
            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                // Crear el método de pago
                const {paymentMethod, error} = await stripe.createPaymentMethod({
                    type: 'card',
                    card: card,
                });

                if (error) {
                    alert(error.message);
                } else {
                    // Asignar el método de pago y enviar el formulario
                    document.getElementById('payment-method').value = paymentMethod.id;
                    form.submit();
                }
            });
        });
    </script>
@endsection
