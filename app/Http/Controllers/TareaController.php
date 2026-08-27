<?php

namespace App\Http\Controllers;

// Importa el modelo para consultar y modificar la tabla tareas.
use App\Models\Tarea;
// Importa la petición que valida los datos recibidos desde los formularios.
use App\Http\Requests\TareaRequest;

/**
 * Controlador para gestionar las operaciones CRUD de tareas.
 * 
 * Este controlador maneja todas las operaciones relacionadas con las tareas:
 * listado, creación, visualización, edición y eliminación. Aplica el 
 * Principio de Responsabilidad Única al delegar la validación al 
 * FormRequest y la lógica de datos al modelo.
 */
class TareaController extends Controller
{
    /**
     * Muestra una lista de todas las tareas.
     * 
     * Recupera todas las tareas de la base de datos y las pasa a la vista
     * para ser mostradas en formato de lista.
     *
     * @return \Illuminate\View\View Vista con el listado de tareas
     */
    public function index()
    {
        // Consulta las tareas ordenadas desde la más nueva hasta la más antigua.
        // Obtener todas las tareas ordenadas por fecha de creación más reciente
        $tareas = Tarea::orderBy('created_at', 'desc')->get();
        
        // Pasar las tareas a la vista 'tareas.index'
        return view('tareas.index', compact('tareas'));
    }

    /**
     * Muestra el formulario para crear una nueva tarea.
     * 
     * Este método simplemente muestra el formulario de creación sin
     * procesar ningún dato. Es necesario para la interfaz de usuario.
     *
     * @return \Illuminate\View\View Vista con el formulario de creación
     */
    public function create()
    {
        // Solo muestra el formulario; todavía no escribe datos en la base de datos.
        // Mostrar la vista 'tareas.create' con el formulario de creación
        return view('tareas.create');
    }

    /**
     * Almacena una nueva tarea creada en el almacenamiento.
     * 
     * Valida los datos del formulario usando el FormRequest TareaRequest,
     * crea una nueva tarea y la guarda en la base de datos.
     *
     * @param \App\Http\Requests\TareaRequest $request Datos validados del formulario
     * @return \Illuminate\Http\RedirectResponse Redirige al listado de tareas
     */
    public function store(TareaRequest $request)
    {
        // validated() devuelve únicamente los campos que superaron las reglas.
        // El FormRequest ya validó los datos, ahora creamos la tarea
        Tarea::create($request->validated());
        
        // Redirigir al listado de tareas con mensaje de éxito
        // Redirige al listado y guarda un mensaje temporal en la sesión.
        return redirect()->route('tareas.index')
                         ->with('success', 'Tarea creada exitosamente.');
    }

    /**
     * Muestra la tarea especificada.
     * 
     * Busca una tarea por su ID y la pasa a la vista para mostrar
     * los detalles completos de la tarea.
     *
    * @param Tarea $tarea Modelo localizado automáticamente por Laravel
     * @return \Illuminate\View\View Vista con los detalles de la tarea
     */
    public function show(Tarea $tarea)
    {
        // El modelo ya fue localizado mediante vinculación implícita de rutas.
        // Pasar la tarea a la vista 'tareas.show'
        return view('tareas.show', compact('tarea'));
    }

    /**
     * Muestra el formulario para editar la tarea especificada.
     * 
     * Busca una tarea por su ID y la pasa a la vista para que el usuario
     * pueda modificar sus datos.
     *
    * @param Tarea $tarea Modelo localizado automáticamente por Laravel
     * @return \Illuminate\View\View Vista con el formulario de edición
     */
    public function edit(Tarea $tarea)
    {
        // Envía la tarea existente al formulario para rellenar sus campos.
        // Pasar la tarea a la vista 'tareas.edit'
        return view('tareas.edit', compact('tarea'));
    }

    /**
     * Actualiza la tarea especificada en el almacenamiento.
     * 
     * Valida los datos del formulario usando el FormRequest TareaRequest,
     * encuentra la tarea existente y actualiza sus datos.
     *
     * @param \App\Http\Requests\TareaRequest $request Datos validados del formulario
    * @param Tarea $tarea Modelo localizado automáticamente por Laravel
     * @return \Illuminate\Http\RedirectResponse Redirige al listado de tareas
     */
    public function update(TareaRequest $request, Tarea $tarea)
    {
        // Recupera los datos validados y evita aceptar campos no autorizados.
        // Actualizar la tarea con los datos validados
        $datos = $request->validated();
        // Un checkbox no enviado significa que la tarea debe quedar pendiente.
        $datos['completada'] = $request->boolean('completada');
        // Persiste los cambios en el registro localizado por Laravel.
        $tarea->update($datos);
        
        // Redirigir al listado de tareas con mensaje de éxito
        // Vuelve al listado con una confirmación temporal para el usuario.
        return redirect()->route('tareas.index')
                         ->with('success', 'Tarea actualizada exitosamente.');
    }

    /**
     * Elimina la tarea especificada del almacenamiento.
     * 
     * Busca la tarea por su ID y la elimina permanentemente de la base de datos.
     * No se puede deshacer esta operación.
     *
    * @param Tarea $tarea Modelo localizado automáticamente por Laravel
     * @return \Illuminate\Http\RedirectResponse Redirige al listado de tareas
     */
    public function destroy(Tarea $tarea)
    {
        // Elimina el registro actual de la tabla tareas.
        // Eliminar la tarea de la base de datos
        $tarea->delete();
        
        // Redirigir al listado de tareas con mensaje de éxito
        return redirect()->route('tareas.index')
                         ->with('success', 'Tarea eliminada exitosamente.');
    }
}
