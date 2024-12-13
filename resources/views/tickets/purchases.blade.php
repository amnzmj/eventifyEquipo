@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Mis Compras</h1>

    @if($tickets->isEmpty())
        <p class="text-muted">Aún no has realizado ninguna compra.</p>
    @else
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->event->name }}</td>
                        <td>{{ $ticket->quantity }}</td>
                        <td>${{ number_format($ticket->total_price, 2) }}</td>
                        <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
