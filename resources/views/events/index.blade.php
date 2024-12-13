@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Lista de Eventos</h1>

    @if($events->isEmpty())
        <p class="text-muted">No hay eventos disponibles.</p>
    @else
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Fecha</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <!-- Columna de imagen -->
                        <td>
                            @if($event->cover_image)
                                <img src="{{ asset('storage/' . $event->cover_image) }}" alt="Imagen del evento" class="img-thumbnail" style="width: 80px; height: 80px;">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>

                        <!-- Columna de nombre -->
                        <td>{{ $event->name }}</td>

                        <!-- Otras columnas -->
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->date->format('d/m/Y') }}</td>
                        <td>${{ number_format($event->price, 2) }}</td>

                        <!-- Columna de acciones -->
                        <td>
                            <!--<a href="{{ route('events.show', $event->id) }}" class="btn btn-primary btn-sm">Ver Evento</a>-->
                            <a href="{{ route('events.buy', $event->id) }}" class="btn btn-success btn-sm">Comprar Boletos</a>
                            <a href="{{ route('events.attendees', $event->id) }}" class="btn btn-info btn-sm">Ver Compradores</a>
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este evento?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
