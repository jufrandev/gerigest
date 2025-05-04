<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityType;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::with('location', 'activityType', 'creator')->paginate(10);
        return view('activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        $activityTypes = ActivityType::all();
        return view('activities.create', compact('locations', 'activityTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location_id' => 'required|exists:locations,id',
            'activity_type_id' => 'required|exists:activity_types,id',
        ]);

        $validated['created_by'] = auth()->id; // Assuming you have authentication set up
        Activity::create($validated);

        return redirect()->route('activities.index')->with('success', 'Actividad creada correctamente.');
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
    public function edit(Activity $activity)
    {
        $locations = Location::all();
        $activityTypes = ActivityType::all();
        return view('activities.edit', compact('activity', 'locations', 'activityTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location_id' => 'required|exists:locations,id',
            'activity_type_id' => 'required|exists:activity_types,id',
        ]);

        $activity->update($validated);

        return redirect()->route('activities.index')->with('success', 'Actividad actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Actividad eliminada correctamente.');
    }

    /**
     * Remove multiple resources from storage.
     */
    public function destroyMultiple(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!empty($ids)) {
            Activity::whereIn('id', $ids)->delete();
            return redirect()->route('activities.index')->with('success', 'Actividades eliminadas correctamente.');
        }

        return redirect()->route('activities.index')->with('error', 'No se seleccionaron actividades para eliminar.');
    }
}
