<?php

namespace App\Http\Requests;

// Permite documentar los tipos aceptados por las reglas de validación.
use Illuminate\Contracts\Validation\ValidationRule;
// Clase base que integra autorización y validación en una petición HTTP.
use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase de validación para las peticiones relacionadas con tareas.
 * 
 * Esta clase se encarga de validar los datos de entrada para las operaciones
 * de creación y actualización de tareas. Aplica el Principio de Responsabilidad
 * Única separando la lógica de validación del controlador.
 */
class TareaRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta petición.
     * 
     * Por defecto, todas las peticiones están autorizadas. Esto se puede modificar
     * para implementar lógica de autorización específica si es necesario.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Devuelve true porque esta aplicación todavía no restringe usuarios.
        return true; // Permitimos todas las peticiones por ahora
    }

    /**
     * Obtiene las reglas de validación que se aplican a la petición.
     * 
     * Define las reglas de validación para los campos del formulario de tareas:
     * - titulo: campo obligatorio (required) y de tipo string
     * - descripcion: campo opcional (nullable) y de tipo string
     * 
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Laravel ejecuta estas reglas antes de llamar a store() o update().
        return [
            'titulo' => ['required', 'string', 'max:255'], // Título obligatorio, string, máximo 255 caracteres
            'descripcion' => ['nullable', 'string', 'max:65535'], // Descripción opcional, tipo string
            'completada' => ['sometimes', 'boolean'], // Estado opcional enviado por el checkbox
        ];
    }

    /**
     * Obtiene los mensajes de error personalizados para las reglas de validación.
     * 
     * Define mensajes en español para los errores de validación, mejorando
     * la experiencia del usuario al mostrar mensajes claros y descriptivos.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        // Personaliza los mensajes para mostrarlos en español.
        return [
            'titulo.required' => 'El título de la tarea es obligatorio.',
            'titulo.string' => 'El título debe ser una cadena de texto.',
            'titulo.max' => 'El título no puede tener más de 255 caracteres.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción es demasiado larga.',
            'completada.boolean' => 'El estado de la tarea no es válido.',
        ];
    }

    /**
     * Obtiene los atributos personalizados para los nombres de los campos.
     * 
     * Permite mostrar nombres más amigables de los campos en los mensajes de error,
     * mejorando la claridad de la comunicación con el usuario.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        // Sustituye los nombres técnicos por etiquetas legibles en los errores.
        return [
            'titulo' => 'título',
            'descripcion' => 'descripción',
            'completada' => 'estado de completado',
        ];
    }
}
