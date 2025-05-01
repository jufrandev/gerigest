<?php

use App\Http\Controllers\ActivityTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

    // Rutas públicas

Route::view('/', 'home')->name('home.landing');
Route::view('/login', 'login')->name('login.form');
Route::view('/login-fail', 'login-fail')->name('login.fail');
Route::view('/quienes-somos', 'quienes-somos')->name('about');
Route::view('/donde-estamos', 'donde-estamos')->name('location');
Route::view('/mission', 'mission')->name('mission');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/contact', 'contact')->name('contact');


    // Rutas con el middleware 'auth'

Route::group(['middleware' => ['auth']], function (){

    // Route::view('/activities', 'activities')->name('activities.index');
    // // TODO: Ruta para procesar formulario de actividades
    // // Route::post('/actividades', [ActividadController::class, 'store']);

    // Route::view('/comunications', 'comunications')->name('comunications.index');
    // // TODO: Ruta para procesar formulario de comunicaciones
    // // Route::post('/comunicaciones', [ComunicacionController::class, 'store']);

    Route::view('/profile', 'profile')->name('profile.view');
    // TODO: Ruta para actualizar perfil
    // Route::post('/profile', [ProfileController::class, 'update']);

    Route::view('/calendar', 'calendar')->name('calendar');

    Route::resource('users', UserController::class)->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);

    Route::delete('/users/{user}/delete', [UserController::class, 'destroySingle'])
        ->name('users.destroySingle');

    Route::delete('notes/destroy-multiple', [NoteController::class, 'destroyMultiple'])
        ->name('notes.destroyMultiple');

    Route::resource('notes', NoteController::class)->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ]);

    Route::delete('activity-types/destroy-multiple', [ActivityTypeController::class, 'destroyMultiple'])->name('activity-types.destroyMultiple');

    Route::resource('activity-types', ActivityTypeController::class);
});

    // Rutas de autenticación

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


