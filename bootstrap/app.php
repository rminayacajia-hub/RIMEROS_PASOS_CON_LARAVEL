<?php

// Importa el constructor de la aplicación Laravel.
use Illuminate\Foundation\Application;
// Permite configurar el tratamiento de excepciones.
use Illuminate\Foundation\Configuration\Exceptions;
// Permite registrar y configurar middleware.
use Illuminate\Foundation\Configuration\Middleware;
// Representa la petición HTTP actual.
use Illuminate\Http\Request;

// Configura Laravel usando como raíz la carpeta principal del proyecto.
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // Registra las rutas web de la aplicación.
        web: __DIR__.'/../routes/web.php',
        // Registra los comandos Artisan personalizados.
        commands: __DIR__.'/../routes/console.php',
        // Define la ruta usada por Laravel para comprobar el estado de la aplicación.
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Aquí se pueden añadir middleware globales o de grupos.
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Las peticiones API o que esperan JSON reciben errores en formato JSON.
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
