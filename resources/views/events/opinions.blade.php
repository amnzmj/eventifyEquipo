@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center text-primary">Opiniones sobre el evento: {{ $event->name }}</h1>

    {{-- Formulario para agregar opinión --}}
    <div class="card shadow mt-4">
        <div class="card-body">
            <h2 class="text-secondary">Deja tu opinión</h2>
            <form action="{{ route('events.opinions.store', $event->id) }}" method="POST" class="mt-3">
                @csrf
                <div class="mb-3">
                    <label for="opinion" class="form-label">Tu Opinión</label>
                    <textarea id="opinion" name="opinion" class="form-control" rows="4" placeholder="Escribe tu opinión aquí..." required></textarea>
                </div>

                <div class="mb-3">
                    <label for="rating" class="form-label">Calificación</label>
                    <select id="rating" name="rating" class="form-select">
                        <option value="1">⭐ - Muy malo</option>
                        <option value="2">⭐⭐ - Malo</option>
                        <option value="3">⭐⭐⭐ - Regular</option>
                        <option value="4">⭐⭐⭐⭐ - Bueno</option>
                        <option value="5">⭐⭐⭐⭐⭐ - Excelente</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success w-100">Enviar Opinión</button>
            </form>
        </div>
    </div>

    <hr>

    {{-- Lista de opiniones --}}
    <h2 class="mt-5 text-secondary">Opiniones de otros usuarios</h2>
    @forelse($event->opinions as $opinion)
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <strong class="me-2">Calificación:</strong>
                    {{-- Mostrar estrellas dinámicamente --}}
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa{{ $i <= $opinion->rating ? 's' : 'r' }} fa-star text-warning"></i>
                    @endfor
                </div>
                <p>{{ $opinion->opinion }}</p>
                <p class="text-muted small">Por: {{ $opinion->user->name }}</p>
            </div>
        </div>
    @empty
        <p class="text-muted">Aún no hay opiniones para este evento.</p>
    @endforelse
</div>
@endsection
