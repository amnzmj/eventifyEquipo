@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-4 text-primary">Eventos Disponibles</h1>
        <p class="lead text-secondary">Selecciona el evento para comprar tus boletos.</p>
    </div>
    <div class="row">
        @foreach ($events as $event)
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 rounded-lg">
                <img src="{{ asset('storage/' . $event->cover_image) }}" class="card-img-top" alt="{{ $event->name }}" style="max-height: 600px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title text-dark">{{ $event->name }}</h5>
                    <p class="card-text text-muted">{{ $event->description }}</p>
                    <p class="text-primary fw-bold">Precio: ${{ $event->price }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('events.buy', $event->id) }}" class="btn btn-primary btn-block rounded-pill">
                        Comprar Boletos
                    </a>
                    <a href="{{ route('events.opinions.index', ['event' => $event->id]) }}" class="btn btn-outline-secondary">Ver opiniones</a>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
