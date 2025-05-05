<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->query('user_id'); // Obtener el ID del usuario desde la solicitud
        $query = Event::with('activity', 'user', 'creator');

        if ($userId) {
            $query->where('user_id', $userId); // Filtrar por usuario si se selecciona uno
        }

        $events = $query->paginate(10);
        $users = User::all(); // Obtener todos los usuarios para el filtro

        return view('events.index', compact('events', 'users'));
    }

    public function create()
    {
        $activities = Activity::all();
        $users = User::all();
        return view('events.create', compact('activities', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'activity_id' => 'required|exists:activities,id',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
        ]);

        $validated['created_by'] = auth()->id();

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Evento creado correctamente.');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $activities = Activity::all();
        $users = User::all();
        return view('events.edit', compact('event', 'activities', 'users'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'activity_id' => 'required|exists:activities,id',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Evento eliminado correctamente.');
    }

    public function destroyMultiple(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!empty($ids)) {
            Event::whereIn('id', $ids)->delete();
            return redirect()->route('events.index')->with('success', 'Eventos eliminados correctamente.');
        }

        return redirect()->route('events.index')->with('error', 'No se seleccionaron eventos para eliminar.');
    }
}
