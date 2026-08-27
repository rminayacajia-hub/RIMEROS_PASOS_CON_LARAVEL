<?php

// Importa la fachada que permite registrar rutas HTTP.
use Illuminate\Support\Facades\Route;
// Importa el controlador que contiene la lógica de las tareas.
use App\Http\Controllers\TareaController;

/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
|
| Aquí es donde se registran las rutas web para la aplicación. Estas
| rutas son cargadas por el RouteServiceProvider y todas ellas
| serán asignadas al grupo de middleware "web".
|
*/

// Rutas para la gestión de tareas (resource routes)
// Genera automáticamente las rutas index, create, store, show, edit, update y destroy.
Route::resource('tareas', TareaController::class);

// Ruta principal que redirige al listado de tareas
// Cuando se visita la página inicial, envía al listado de tareas.
Route::get('/', function () {
    // Redirige usando el nombre de la ruta, evitando escribir su URL manualmente.
    return redirect()->route('tareas.index');
// Asigna el nombre "home" a esta ruta para poder referenciarla desde las vistas.
})->name('home');

/*
|--------------------------------------------------------------------------
| Notas sobre las rutas generadas
|--------------------------------------------------------------------------
|
| Route::resource('tareas', TareaController::class) genera automáticamente las siguientes rutas:
|
| Método    | URI                   | Nombre de ruta      | Controlador@Método     | Descripción
|-----------|-----------------------|-------------------|-----------------------|---------------------------
| GET       | /tareas              | tareas.index      | TareaController@index  | Muestra listado de tareas
| GET       | /tareas/create       | tareas.create     | TareaController@create| Muestra formulario de creación
| POST      | /tareas              | tareas.store      | TareaController@store  | Almacena nueva tarea
| GET       | /tareas/{tarea}       | tareas.show       | TareaController@show   | Muestra tarea específica
| GET       | /tareas/{tarea}/edit | tareas.edit       | TareaController@edit | Muestra formulario de edición
| PUT/PATCH | /tareas/{tarea}       | tareas.update     | TareaController@update | Actualiza tarea existente
| DELETE    | /tareas/{tarea}       | tareas.destroy    | TareaController@destroy| Elimina tarea
|
*/
