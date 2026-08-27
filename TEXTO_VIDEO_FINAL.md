# Texto final del video

## Introducción

Buenas tardes, en este video voy a presentar una aplicación de gestión de tareas desarrollada con Laravel. Esta aplicación permite crear, listar, consultar, editar y eliminar tareas, además de marcar una tarea como completada.

El objetivo principal es demostrar cómo se trabaja con los conceptos fundamentales de Laravel, como la configuración del proyecto, la conexión a la base de datos, las migraciones, los modelos, las rutas, los controladores y las vistas con Blade.

## 1. Configuración inicial

Primero creamos el proyecto Laravel con Composer. Luego configuramos el archivo `.env` para conectarlo a la base de datos MySQL del entorno local. En este caso, la base de datos se llama `gestion_tareas` y se utiliza la versión de PHP de MAMP para levantar la aplicación.

Una vez configurado, ejecutamos el servidor con Laravel para poder abrir la aplicación en el navegador.

## 2. Estructura de la base de datos

Para guardar las tareas necesitamos una tabla en la base de datos. En esta aplicación la tabla se llama `tareas` y cuenta con los siguientes campos: `id`, `titulo`, `descripcion`, `completada` y los timestamps `created_at` y `updated_at`.

La migración define esta estructura y permite crear la tabla con el comando `php artisan migrate`.

La columna `titulo` es obligatoria, la descripción es opcional y `completada` tiene valor por defecto `false`, lo que significa que la tarea empieza como pendiente.

## 3. Modelo

El modelo `Tarea` representa la tabla de tareas en la aplicación. Define el nombre de la tabla y los campos que pueden asignarse masivamente mediante `$fillable`.

Esto permite que Laravel cree y actualice registros de forma segura utilizando el modelo Eloquent.

## 4. Rutas y controlador

En Laravel, la ruta `Route::resource('tareas', TareaController::class)` genera automáticamente las rutas para realizar el CRUD completo. Esto incluye la vista principal de tareas, la creación, la edición, la visualización y la eliminación.

El controlador `TareaController` se encarga de recibir las peticiones, interactuar con el modelo y devolver las vistas o redireccionar al usuario según la acción realizada.

## 5. Vistas con Blade

Las vistas se construyen con Blade y se organizan de forma clara para cada operación del sistema. Existe una plantilla base llamada `layout.blade.php` y luego las vistas específicas para listar, crear, editar y mostrar una tarea.

Estas vistas permiten:

- mostrar la lista de tareas,
- crear nuevas tareas,
- editar una existente,
- ver el detalle de la tarea,
- y presentar mensajes de confirmación o errores de validación.

## 6. Funcionalidad general

La aplicación permite realizar las operaciones fundamentales de un CRUD: crear, leer, actualizar y eliminar tareas.

Además, la validación de formularios ayuda a garantizar que el título sea obligatorio y que los datos se almacenen correctamente. Esto hace que la aplicación sea más segura y más ordenada desde el punto de vista del desarrollo.

## Cierre

En resumen, esta aplicación demuestra los fundamentos de Laravel: configuración, base de datos, migraciones, modelos, rutas, controladores, vistas Blade y validación de formularios. Con esto se construye una aplicación funcional de gestión de tareas siguiendo buenas prácticas del framework.

