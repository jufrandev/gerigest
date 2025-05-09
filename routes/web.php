<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityTypeController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

    // Rutas públicas

Route::view('/', 'home')->name('home.landing');
Route::view('/home', 'home')->name('home');
Route::view('/login', 'login')->name('login.form');
Route::view('/login-fail', 'login-fail')->name('login.fail');
Route::view('/quienes-somos', 'quienes-somos')->name('about');
Route::view('/donde-estamos', 'donde-estamos')->name('location');
Route::view('/mission', 'mission')->name('mission');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/contact', 'contact')->name('contact');


    // Rutas con el middleware 'auth'

Route::group(['middleware' => ['auth']], function (){

    Route::view('/profile', 'profile')->name('profile.view');

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

    Route::delete('locations/destroy-multiple', [LocationController::class, 'destroyMultiple'])->name('locations.destroyMultiple');

    Route::resource('locations', LocationController::class);

    Route::delete('activities/destroy-multiple', [ActivityController::class, 'destroyMultiple'])->name('activities.destroyMultiple');

    Route::resource('activities', ActivityController::class);

    Route::delete('events/destroy-multiple', [EventController::class, 'destroyMultiple'])->name('events.destroyMultiple');

    Route::get('events/calendar', [EventController::class, 'calendar'])->name('events.calendar');

    Route::get('events/calendar-data', [EventController::class, 'calendarData'])->name('events.calendarData');

    Route::resource('events', EventController::class);

});

    // Rutas de autenticación

Auth::routes();


