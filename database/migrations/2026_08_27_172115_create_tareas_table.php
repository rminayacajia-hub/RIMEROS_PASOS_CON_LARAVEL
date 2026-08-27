<?php

// Clase base para crear una migración reversible.
use Illuminate\Database\Migrations\Migration;
// Permite definir columnas dentro de una tabla.
use Illuminate\Database\Schema\Blueprint;
// Fachada usada para crear y eliminar tablas.
use Illuminate\Support\Facades\Schema;

// Devuelve una migración anónima que Laravel ejecuta por fecha.
return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     * Crea la tabla 'tareas' con sus columnas definidas.
     */
    public function up(): void
    {
        // Crea la tabla solo cuando se ejecuta php artisan migrate.
        Schema::create('tareas', function (Blueprint $table) {
            $table->id(); // Columna ID autoincremental como clave primaria
            $table->string('titulo'); // Columna para el título de la tarea (string, requerido)
            $table->text('descripcion')->nullable(); // Columna para la descripción (texto, opcional)
            $table->boolean('completada')->default(false); // Columna booleana para estado de completado, por defecto false
            $table->timestamps(); // Columnas para timestamps (created_at y updated_at)
        });
    }

    /**
     * Revierte las migraciones.
     * Elimina la tabla 'tareas' si existe.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
