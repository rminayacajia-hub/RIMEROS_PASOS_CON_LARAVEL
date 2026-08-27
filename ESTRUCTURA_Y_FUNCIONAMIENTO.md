# Gestión de tareas con Laravel

## Descripción

Aplicación web básica para administrar tareas mediante operaciones CRUD:
crear, listar, consultar, editar y eliminar. La aplicación mantiene la nomenclatura en español para que el código y la interfaz sean fáciles de seguir.

## Requisitos

- PHP 8.3 o superior.
- Composer.
- MySQL de MAMP encendido.
- Base de datos `gestion_tareas`.
- Node.js y npm, si se modifican los recursos frontend.

## Puesta en marcha en Windows con MAMP

Desde la carpeta `gestion_tareas`:

```powershell
$env:Path = "C:\MAMP\bin\php\php8.3.1;$env:Path"
php -v
php artisan migrate
php artisan serve
```

Abrir `http://127.0.0.1:8000`.

Si Composer no está en el `PATH`, el workspace incluye un lanzador local:

```powershell
& "C:\MAMP\bin\php\php8.3.1\php.exe" ..\bin\composer install
```

## Configuración

El archivo `.env` define la aplicación y la conexión a MySQL:

```dotenv
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=gestion_tareas
DB_USERNAME=root
```

La contraseña depende de la configuración local de MAMP. El archivo `.env` no debe compartirse ni versionarse.

## Estructura principal

```text
 gestion_tareas/
 ├── app/
 │   ├── Http/
 │   │   ├── Controllers/TareaController.php
 │   │   └── Requests/TareaRequest.php
 │   └── Models/Tarea.php
 ├── database/
 │   └── migrations/2026_08_27_172115_create_tareas_table.php
 ├── resources/views/
 │   ├── layout.blade.php
 │   └── tareas/
 │       ├── index.blade.php
 │       ├── create.blade.php
 │       ├── edit.blade.php
 │       └── show.blade.php
 ├── routes/web.php
 ├── tests/Feature/TareaCrudTest.php
 └── artisan
```

## Modelo de datos

La migración crea la tabla `tareas` con:

- `id`: clave primaria autoincremental.
- `titulo`: texto obligatorio de hasta 255 caracteres.
- `descripcion`: texto opcional.
- `completada`: booleano con valor predeterminado `false`.
- `created_at` y `updated_at`: marcas de tiempo automáticas.

El modelo `Tarea` declara los campos asignables masivamente y convierte `completada` a booleano.

## Funcionamiento

`routes/web.php` registra `Route::resource('tareas', TareaController::class)`, que crea las rutas para las siete acciones resource:

- `index`: muestra todas las tareas.
- `create`: muestra el formulario de alta.
- `store`: valida y guarda una tarea.
- `show`: muestra el detalle de una tarea.
- `edit`: muestra el formulario de edición.
- `update`: valida y actualiza una tarea.
- `destroy`: elimina una tarea.

`TareaRequest` centraliza la validación. El controlador usa vinculación implícita de modelos, por lo que una tarea inexistente produce una respuesta `404` automáticamente.

## Pruebas y comprobaciones

Ejecutar las pruebas con:

```powershell
php artisan test
```

La suite comprueba el listado, creación, validación del título, detalle, actualización del estado y eliminación. Para compilar las vistas Blade:

```powershell
php artisan view:cache
```

## Recomendaciones futuras

1. Añadir autenticación y asociar cada tarea a un usuario.
2. Incorporar paginación cuando aumente el número de tareas.
3. Permitir cambiar el estado directamente desde el listado.
4. Añadir filtros para tareas pendientes y completadas.
5. Crear una fábrica y un seeder de tareas para datos de demostración.
6. Configurar CI para ejecutar pruebas y estilo automáticamente.
7. Revisar los recursos Bootstrap y Font Awesome para servirlos localmente si no se desea depender de CDN.
