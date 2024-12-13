@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Compradores para el evento: {{ $event->name }}</h1>
    <p><strong>Ubicación:</strong> {{ $event->location }}</p>
    <p><strong>Fecha:</strong> {{ $event->date->format('d/m/Y') }}</p>
    <p><strong>Precio por boleto:</strong> ${{ number_format($event->price, 2) }}</p>

    <hr>

    @if($attendees->isEmpty())
        <p class="text-muted">Aún no hay compradores para este evento.</p>
    @else
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Nombre del Comprador</th>
                    <th>Cantidad de Boletos</th>
                    <th>Total Pagado</th>
                    <th>Fecha de Compra</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendees as $ticket)
                    <tr>
                        <td>{{ $ticket->user->name }}</td>
                        <td>{{ $ticket->quantity }}</td>
                        <td>${{ number_format($ticket->total_price, 2) }}</td>
                        <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('events.index') }}" class="btn btn-secondary mt-4">Volver a la lista de eventos</a>
</div>
@endsection
