<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener pacientes para asignar familiares (si es necesario)
        $patients = User::whereHas('roles', function ($query) {
            $query->where('name', 'usuario');
        })->get();

        return view('users.create', compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,sociosanitario,usuario,familiar',
        ]);

        // Crear el usuario
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);
        // Asignar el rol
        $user->assignRole($validated['role']);

        // Guardar datos adicionales según el rol
        if ($validated['role'] === 'sociosanitario') {
            $user->healthcareWorker()->create([
                'qualification' => $request->input('qualification'),
            ]);
        } elseif ($validated['role'] === 'usuario') {
            $user->patient()->create([
                'room_number' => $request->input('room_number'),
            ]);
        } elseif ($validated['role'] === 'familiar') {
            foreach ($request->input('related_patients', []) as $patientId) {
                $user->familyMembers()->create([
                    'patient_id' => $patientId,
                ]);
            }
        }

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('roles', 'patient', 'familyMembers', 'healthcareWorker');

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        // Cargar relaciones necesarias
        $user->load('roles', 'patient', 'familyMembers', 'healthcareWorker');

        // Obtener pacientes para asignar familiares (si es necesario)
        $patients = User::whereHas('roles', function ($query) {
            $query->where('name', 'usuario');
        })->get();

        return view('users.edit', compact('user', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        // Actualizar datos básicos del usuario
        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
        ]);

        // Actualizar datos adicionales según el rol
        if ($user->hasRole('sociosanitario')) {
            $user->healthcareWorker()->updateOrCreate([], [
                'qualification' => $request->input('qualification'),
            ]);
        } elseif ($user->hasRole('usuario')) {
            $user->patient()->updateOrCreate([], [
                'room_number' => $request->input('room_number'),
            ]);
        } elseif ($user->hasRole('familiar')) {
            $user->familyMembers()->delete();
            foreach ($request->input('related_patients', []) as $patientId) {
                $user->familyMembers()->create([
                    'patient_id' => $patientId,
                ]);
            }
        }

        return redirect()->route('users.show', $user)->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroySingle(User $user)
    {
        // Eliminar el usuario
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:users,id',
        ]);

        // Eliminar los usuarios seleccionados
        User::whereIn('id', $validated['ids'])->delete();

        return redirect()->route('users.index')->with('success', 'Usuarios eliminados correctamente.');
    }
}
