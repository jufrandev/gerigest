<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\NoteType;
use App\Models\Priority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Note::with('createdBy', 'noteType'); // Cargar relaciones necesarias

        // Filtros
        if ($request->filled('author')) {
            $query->where('created_by', $request->author);
        }
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                ->orWhere('content', 'like', "%{$request->search}%");
            });
        }
        if ($request->filled('note_type_id')) {
            $query->where('note_type_id', $request->note_type_id);
        }

        // Ordenar
        $query->orderBy($request->get('sort_by', 'created_at'), $request->get('order', 'desc'));

        $notes = $query->paginate(10);

        $noteTypes = \App\Models\NoteType::all(); // Obtener los tipos de anotaciónpara el filtro
        $authors = \App\Models\User::all(); // Obtener todos los usuarios para el filtro de autor

        return view('notes.index', compact('notes', 'noteTypes', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $noteTypes = NoteType::all();
        $priorities = Priority::all();
        return view('notes.create', compact('noteTypes', 'priorities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'note_type_id' => 'nullable|exists:note_types,id',
            'priority_id' => 'nullable|exists:priorities,id',
        ]);

        Note::create([
            'created_by' => Auth::id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'note_type_id' => $validated['note_type_id'],
            'priority_id' => $validated['priority_id'],
        ]);

        return redirect()->route('notes.index')->with('success', ucfirst('anotación creada correctamente.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        $noteTypes = NoteType::all();
        $priorities = Priority::all();
        return view('notes.edit', compact('note', 'noteTypes', 'priorities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'note_type_id' => 'nullable|exists:note_types,id',
            'priority_id' => 'nullable|exists:priorities,id',
        ]);

        $note->update($validated);

        return redirect()->route('notes.show', $note)->with('success', ucfirst('anotación actualizada correctamente.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index')->with('success', ucfirst('anotación eliminada correctamente.'));
    }

    public function destroyMultiple(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!empty($ids)) {
            Note::whereIn('id', $ids)->delete();
            return redirect()->route('notes.index')->with('success', ucfirst('anotaciones eliminadas correctamente.'));
        }

        return redirect()->route('notes.index')->with('error', 'No se seleccionaron anotaciones para eliminar.');
    }
}
