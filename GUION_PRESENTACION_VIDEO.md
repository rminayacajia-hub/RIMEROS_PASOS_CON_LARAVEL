# Guion de presentación para grabar el video

## Introducción

[Inicio con una sonrisa y mirada a la cámara]

"Hola, bienvenidos. En este video voy a presentar una aplicación de gestión de tareas desarrollada con Laravel. La idea es mostrar cómo se puede construir una To-Do List funcional utilizando los conceptos básicos del framework."

## 1. Presentación del proyecto

"La aplicación permite crear tareas, listarlas, ver su detalle, editarlas y eliminarlas. También incluye la opción de marcar una tarea como completada."

"Este proyecto demuestra de forma práctica cómo trabajar con Laravel en un caso real de gestión de información."

## 2. Configuración inicial

"Primero realizamos la configuración inicial del proyecto. Se crea la aplicación con Composer y luego se configura el archivo `.env` para conectar Laravel a la base de datos MySQL."

"En este caso, la base de datos se llama `gestion_tareas` y se trabaja con la versión de PHP de MAMP para levantar la aplicación localmente."

"Después, ejecutamos el servidor con Artisan para poder abrir la aplicación en el navegador."

## 3. Estructura de la base de datos

"Para guardar la información de las tareas, necesitamos una tabla. En esta aplicación se crea una migración para la tabla `tareas`, con campos como `id`, `titulo`, `descripcion`, `completada`, `created_at` y `updated_at`."

"El título es obligatorio, la descripción es opcional y el estado de la tarea empieza en falso, lo que significa que la tarea está pendiente."

"Luego ejecutamos la migración con `php artisan migrate`, y Laravel crea la tabla automáticamente en la base de datos."

## 4. Modelo

"El siguiente paso es crear el modelo `Tarea`, que representa la tabla de tareas en la base de datos."

"En el modelo se define el nombre de la tabla y los campos permitidos para asignación masiva con `$fillable`, lo que ayuda a proteger la aplicación y controlar qué datos pueden guardarse."

## 5. Rutas y controlador

"Para gestionar las tareas, Laravel usa rutas y un controlador. La instrucción `Route::resource('tareas', TareaController::class)` genera automáticamente las rutas necesarias para crear, listar, editar y eliminar tareas."

"El `TareaController` es el encargado de manejar cada una de estas operaciones. Aquí se procesa la lógica del CRUD y se conecta con el modelo para consultar o modificar la base de datos."

## 6. Vistas con Blade

"Las interfaces se construyen con Blade. Se usa una plantilla base llamada `layout.blade.php` para mantener una estructura común y luego se crean vistas específicas para cada acción: listado, creación, edición y detalle de tarea."

"Esto permite mantener el código organizado y reutilizable, además de mejorar la experiencia visual del usuario."

## 7. Funcionalidad del CRUD

"La aplicación permite realizar las operaciones esenciales: crear una nueva tarea, mostrar todas las tareas, ver una tarea en detalle, actualizar su información y eliminarla cuando ya no se necesita."

"También se implementa la validación de datos para asegurar que el título sea obligatorio antes de guardar la información."

## 8. Cierre

"Con esto concluimos la presentación del proyecto. Podemos observar que Laravel ofrece una estructura clara y ordenada para desarrollar aplicaciones web de forma eficiente."

"Este ejemplo demuestra los principios fundamentales del framework y cómo se integran todas sus partes para construir una aplicación real de gestión de tareas."

[Finaliza con una pausa y una frase final]

"Gracias por ver este video."
