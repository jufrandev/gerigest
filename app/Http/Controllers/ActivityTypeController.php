<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\ActivityType;

class ActivityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activityTypes = ActivityType::paginate(10);
        return view('activity_types.index', compact('activityTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activity_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:activity_types',
            'description' => 'nullable|string',
        ]);

        ActivityType::create($validated);

        return redirect()->route('activity-types.index')->with('success', 'Tipo de actividad creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActivityType $activityType)
    {
        return view('activity_types.edit', compact('activityType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ActivityType $activityType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:activity_types,name,' . $activityType->id,
            'description' => 'nullable|string',
        ]);

        $activityType->update($validated);

        return redirect()->route('activity-types.index')->with('success', 'Tipo de actividad actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivityType $activityType)
    {
        $activityType->delete();

        return redirect()->route('activity-types.index')->with('success', 'Tipo de actividad eliminado correctamente.');
    }


    public function destroyMultiple(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!empty($ids)) {
            ActivityType::whereIn('id', $ids)->delete();
            return redirect()->route('activity-types.index')->with('success', 'Tipos de actividad eliminados correctamente.');
        }

        return redirect()->route('activity-types.index')->with('error', 'No se seleccionaron tipos de actividad para eliminar.');
    }
}
