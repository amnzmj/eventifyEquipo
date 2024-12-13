@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Compras</h1>

    @if($tickets->isEmpty())
        <p>No has realizado compras aún.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Cantidad</th>
                    <th>Precio Total</th>
                    <th>Fecha de Compra</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->event->name }}</td>
                        <td>{{ $ticket->quantity }}</td>
                        <td>${{ $ticket->total_price }}</td>
                        <td>{{ $ticket->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
