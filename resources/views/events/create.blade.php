@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">Crear Nuevo Evento</h1>

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="p-4 bg-light rounded shadow">
        @csrf

        <!-- Nombre del Evento -->
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Evento:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <!-- Ubicación -->
        <div class="mb-3">
            <label for="location" class="form-label">Ubicación:</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" required>
        </div>

        <!-- Fecha -->
        <div class="mb-3">
            <label for="date" class="form-label">Fecha:</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
        </div>

        <!-- Descripción -->
        <div class="mb-3">
            <label for="description" class="form-label">Descripción:</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>

        <!-- Precio -->
        <div class="mb-3">
            <label for="price" class="form-label">Precio:</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price') }}" required>
        </div>

        <!-- Imagen de Portada -->
        <div class="mb-3">
            <label for="cover_image" class="form-label">Imagen de Portada:</label>
            <input type="file" name="cover_image" id="cover_image" class="form-control">
        </div>

        <!-- Imagen del Lugar -->
        <div class="mb-3">
            <label for="venue_image" class="form-label">Imagen del Lugar:</label>
            <input type="file" name="venue_image" id="venue_image" class="form-control">
        </div>

        <!-- Botón de Guardar -->
        <div class="text-center">
            <button type="submit" class="btn btn-success px-5">Guardar</button>
        </div>
    </form>
</div>
@endsection
