<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Compra de Boletos</title>
</head>
<body>
    <h1>¡Gracias por tu compra!</h1>
    <p>Hola {{ $ticket->user->name }},</p>
    <p>Has comprado <strong>{{ $ticket->quantity }}</strong> boleto(s) para el evento <strong>{{ $ticket->event->name }}</strong>.</p>
    <p>Detalles del evento:</p>
    <ul>
        <li><strong>Nombre:</strong> {{ $ticket->event->name }}</li>
        <li><strong>Fecha:</strong> {{ $ticket->event->date->format('d/m/Y') }}</li>
        <li><strong>Ubicación:</strong> {{ $ticket->event->location }}</li>
        <li><strong>Precio Total:</strong> ${{ number_format($ticket->total_price, 2) }}</li>
    </ul>
    <p>Esperamos que disfrutes del evento. ¡Nos vemos pronto!</p>
</body>
</html>
