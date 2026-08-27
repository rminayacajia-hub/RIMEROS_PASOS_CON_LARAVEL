<?php

namespace App\Models;

// Importa la clase base que convierte este modelo en un modelo Eloquent.
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Tarea que representa la tabla 'tareas' en la base de datos.
 * 
 * Este modelo gestiona la interacción con la tabla tareas, permitiendo
 * operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre los registros
 * de tareas en la aplicación.
 */
class Tarea extends Model
{
    /**
     * Define el nombre de la tabla asociada al modelo.
     * 
     * Por defecto, Laravel usa el nombre del modelo en plural y minúsculas,
     * pero lo especificamos explícitamente para mayor claridad.
     *
     * @var string
     */
    // Indica explícitamente el nombre de la tabla usada en la base de datos.
    protected $table = 'tareas';

    /**
     * Define los campos que se pueden asignar masivamente (mass assignment).
     * 
     * Estos son los campos que pueden ser llenados mediante arrays o formularios
     * sin riesgo de asignación masiva no deseada. Laravel protege contra
     * asignación masiva por seguridad, por lo que我们必须 especificar 
     * explícitamente qué campos son seguros para asignación.
     *
     * @var array
     */
    // Define los atributos permitidos en Tarea::create() y $tarea->update().
    protected $fillable = [
        'titulo',        // Título de la tarea (obligatorio)
        'descripcion',    // Descripción detallada de la tarea (opcional)
        'completada',    // Estado de completado de la tarea (booleano)
    ];

    // Convierte el valor de la base de datos en booleano al leerlo.
    protected $casts = [
        'completada' => 'boolean',
    ];

    /**
     * Indica si el modelo debe registrar timestamps (created_at, updated_at).
     * 
     * Por defecto es true, lo que automáticamente maneja las fechas de creación
     * y actualización de registros. Lo mantenemos en true para llevar un control
     * de cuando se crean y modifican las tareas.
     *
     * @var bool
     */
    // Permite que Laravel gestione automáticamente created_at y updated_at.
    public $timestamps = true;
}
