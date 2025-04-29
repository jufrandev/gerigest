<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});
// La ruta por encima de este comentario muestra el formulario de inicio de sesión
// La ruta por debajo de este comentario recibe la información del formulario de inicio de sesión
Route::post('/login', function () {
    return view('login');
});

Route::get('/login-fail', function () {
    return view('login-fail');
});

Route::get('/activities', function () {
    return view('activities');
});
// La ruta por encima de este comentario muestra los formularios relacionados con las actividades
// La ruta por debajo de este comentario recibe la información de los formularios relacionados con las actividades
Route::post('/actividades', function () {
    return view('activities');
});

Route::get('/comunications', function () {
    return view('comunications');
});
// La ruta por encima de este comentario muestra los formularios relacionados con las comunicaciones bien sean de informacion, incidencias, sugerencias o quejas
// La ruta por debajo de este comentario recibe la información de los formularios relacionados con las comunicaciones bien sean de informacion, incidencias, sugerencias o quejas
Route::post('/comunicaciones', function () {
    return view('comunications');
});

Route::get('/profile', function () {
    return view('profile');
});
// La ruta por encima de este comentario muestra el perfil del usuario
// La ruta por debajo de este comentario recibe la información del formulario de edición del perfil
Route::post('/profile', function () {
    return view('profile');
});

Route::get('/quienes-somos', function () {
    return view('quienes-somos');
});

Route::get('/donde-estamos', function () {
    return view('donde-estamos');
});

Route::get('/mission', function () {
    return view('mission');
});

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/calendar', function () {
    return view('calendar');
});

Route::resource('/users', UserController::class)->only([
    'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
]);

Route::delete('/users/{user}/delete', [UserController::class, 'destroySingle'])->name('users.destroySingle');
