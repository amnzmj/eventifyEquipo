<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Opinion;

use Illuminate\Http\Request;


class EventController extends Controller
{
    /**
     * Mostrar la lista de eventos.
     */
    public function index()
    {
        $events = Event::all(); // Obtener todos los eventos
        return view('events.index', compact('events'));
    }

    /**
     * Mostrar el formulario para crear un nuevo evento.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Guardar un nuevo evento en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'venue_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Subir imagen de portada
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('events', 'public');
        }

        // Subir imagen del lugar
        if ($request->hasFile('venue_image')) {
            $data['venue_image'] = $request->file('venue_image')->store('events', 'public');
        }

        Event::create($data);

        return redirect()->route('events.index')->with('success', 'Evento creado exitosamente.');
    }

    /**
     * Mostrar el formulario para editar un evento existente.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Actualizar un evento existente en la base de datos.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'venue_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Subir nueva imagen de portada si se selecciona
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('events', 'public');
        }

        // Subir nueva imagen del lugar si se selecciona
        if ($request->hasFile('venue_image')) {
            $data['venue_image'] = $request->file('venue_image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('events.index')->with('success', 'Evento actualizado exitosamente.');
    }

    /**
     * Eliminar un evento de la base de datos.
     */
    public function destroy(Event $event)
    {
        // Eliminar las imágenes asociadas si existen
        if ($event->cover_image) {
            \Storage::delete('public/' . $event->cover_image);
        }

        if ($event->venue_image) {
            \Storage::delete('public/' . $event->venue_image);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Evento eliminado exitosamente.');
    }

    public function publicList()
    {
        $events = Event::all(); // Obtén todos los eventos
        return view('events.public', compact('events')); // Retorna la vista con los eventos
    }

    public function opinions(Event $event)
    {
        return view('events.opinions', compact('event'));
    }

    public function storeOpinion(Request $request, $eventId)
    {
        $validated = $request->validate([
            'opinion' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,5', // Valida que la calificación esté entre 1 y 5
        ]);

        $opinion = new Opinion();
        $opinion->user_id = auth()->id(); // Asume que el usuario está autenticado
        $opinion->event_id = $eventId; // Asigna el ID del evento desde la ruta
        $opinion->opinion = $validated['opinion'];
        $opinion->rating = $validated['rating']; // Asegúrate de guardar la calificación
        $opinion->save();

        return redirect()->route('events.opinions.index', ['event' => $eventId])
                 ->with('success', 'Tu opinión se ha guardado correctamente.');

    }





}
