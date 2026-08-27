# Guía para grabar el video del proyecto

## 1. Presentación inicial

Puedes comenzar diciendo:

> En este video voy a presentar una aplicación de gestión de tareas creada con Laravel. La aplicación permite crear, listar, consultar, editar y eliminar tareas. También permite marcar una tarea como completada.

La aplicación utiliza Laravel en el backend, Blade para las vistas, Eloquent para comunicarse con la base de datos y MySQL mediante MAMP.

## 2. Estructura que debes mostrar

En el explorador de VS Code muestra estas carpetas:

```text
app/
├── Http/
│   ├── Controllers/TareaController.php
│   └── Requests/TareaRequest.php
└── Models/Tarea.php

database/migrations/
└── 2026_08_27_172115_create_tareas_table.php

resources/views/
├── layout.blade.php
└── tareas/
    ├── index.blade.php
    ├── create.blade.php
    ├── edit.blade.php
    └── show.blade.php

routes/web.php
tests/Feature/TareaCrudTest.php
```

Explicación para el video:

- `app`: contiene la lógica principal de la aplicación.
- `Controllers`: recibe las peticiones y decide qué operación realizar.
- `Requests`: valida los datos enviados por el usuario.
- `Models`: representa las tablas de la base de datos.
- `database/migrations`: define la estructura de las tablas.
- `resources/views`: contiene las páginas HTML escritas con Blade.
- `routes`: define las direcciones URL disponibles.
- `tests`: contiene pruebas automáticas del funcionamiento.

## 4. Explicación de la configuración de base de datos

Abre el archivo `.env` y muestra solamente las variables de conexión, sin enseñar contraseñas:

```dotenv
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=gestion_tareas
DB_USERNAME=root
```

Puedes explicar:

> El archivo `.env` contiene la configuración específica del entorno local. Laravel utiliza estos valores para conectarse a MySQL.

## 5. Explicación de la migración

Abre:

`database/migrations/2026_08_27_172115_create_tareas_table.php`

Explica las líneas principales:

```php
Schema::create('tareas', function (Blueprint $table) {
    $table->id();
    $table->string('titulo');
    $table->text('descripcion')->nullable();
    $table->boolean('completada')->default(false);
    $table->timestamps();
});
```

- `Schema::create('tareas')` crea la tabla `tareas`.
- `$table->id()` crea el identificador único y autoincremental.
- `string('titulo')` crea el título obligatorio.
- `text('descripcion')->nullable()` permite una descripción larga y opcional.
- `boolean('completada')->default(false)` guarda el estado y comienza como pendiente.
- `timestamps()` crea `created_at` y `updated_at`.
- El método `down()` elimina la tabla si se revierte la migración.

## 6. Explicación del modelo

Abre:

`app/Models/Tarea.php`

Explica:

```php
class Tarea extends Model
{
    protected $table = 'tareas';

    protected $fillable = [
        'titulo',
        'descripcion',
        'completada',
    ];

    protected $casts = [
        'completada' => 'boolean',
    ];
}
```

- `extends Model` permite usar Eloquent.
- `$table` indica la tabla relacionada.
- `$fillable` protege la asignación masiva y enumera los campos permitidos.
- `$casts` convierte `completada` a un valor booleano `true` o `false`.
- `$timestamps = true` permite que Laravel gestione las fechas automáticamente.

## 7. Explicación de las rutas

Abre:

`routes/web.php`

Muestra esta línea:

```php
Route::resource('tareas', TareaController::class);
```

Explica que Laravel genera automáticamente siete rutas:

| Acción | Método | URL | Método del controlador |
|---|---|---|---|
| Listar | GET | `/tareas` | `index` |
| Formulario nuevo | GET | `/tareas/create` | `create` |
| Guardar | POST | `/tareas` | `store` |
| Ver detalle | GET | `/tareas/{tarea}` | `show` |
| Formulario editar | GET | `/tareas/{tarea}/edit` | `edit` |
| Actualizar | PUT/PATCH | `/tareas/{tarea}` | `update` |
| Eliminar | DELETE | `/tareas/{tarea}` | `destroy` |

La ruta `/` redirige al listado para que la aplicación comience en la página principal de tareas.

## 8. Explicación del controlador

Abre:

`app/Http/Controllers/TareaController.php`

### Método `index`

```php
$tareas = Tarea::orderBy('created_at', 'desc')->get();
return view('tareas.index', compact('tareas'));
```

> Consulta todas las tareas, ordena las más recientes primero y envía la colección a la vista `tareas.index`.

### Método `create`

```php
return view('tareas.create');
```

> Muestra el formulario vacío para crear una tarea. Todavía no guarda información.

### Método `store`

```php
Tarea::create($request->validated());
return redirect()->route('tareas.index')
    ->with('success', 'Tarea creada exitosamente.');
```

> Recibe la petición validada, crea el registro y redirige al listado mostrando un mensaje de confirmación.

### Método `show`

```php
public function show(Tarea $tarea)
{
    return view('tareas.show', compact('tarea'));
}
```

> Laravel busca automáticamente la tarea usando el ID de la URL. Después envía el modelo a la vista de detalle. Si no existe, Laravel responde con un error 404.

### Método `edit`

> Busca automáticamente la tarea y abre el formulario con sus datos actuales.

### Método `update`

```php
$datos = $request->validated();
$datos['completada'] = $request->boolean('completada');
$tarea->update($datos);
```

> Recupera los datos válidos, convierte el checkbox a booleano y actualiza la tarea. Si el checkbox no se envía, se guarda como `false`.

### Método `destroy`

```php
$tarea->delete();
return redirect()->route('tareas.index');
```

> Elimina la tarea localizada y vuelve al listado.

## 9. Explicación de la validación

Abre:

`app/Http/Requests/TareaRequest.php`

Muestra:

```php
return [
    'titulo' => ['required', 'string', 'max:255'],
    'descripcion' => ['nullable', 'string', 'max:65535'],
    'completada' => ['sometimes', 'boolean'],
];
```

Explica:

- `required`: el título es obligatorio.
- `string`: el valor debe ser texto.
- `max:255`: limita el título a 255 caracteres.
- `nullable`: permite que la descripción esté vacía.
- `sometimes`: valida `completada` si el campo fue enviado.
- `boolean`: solo acepta valores booleanos válidos.

`authorize()` devuelve `true` porque todavía no se ha agregado autenticación ni permisos de usuario.

## 10. Explicación de las vistas Blade

### `layout.blade.php`

Es la plantilla común. Contiene:

- Estructura HTML general.
- Barra de navegación.
- Carga de Bootstrap, Font Awesome y tipografías.
- Estilos visuales y responsive.
- Mensajes de éxito y error.
- `@yield('content')`, donde cada página inserta su contenido.

### `index.blade.php`

Muestra:

- Total de tareas.
- Tareas completadas.
- Tareas pendientes.
- Porcentaje de progreso.
- Tabla con las tareas y sus acciones.

El ciclo `@foreach` recorre cada tarea y la imprime en una fila.

### `create.blade.php`

Contiene el formulario de creación:

- `action` apunta a `tareas.store`.
- `method="POST"` indica que se enviarán datos.
- `@csrf` protege contra falsificación de peticiones.
- `old()` conserva los valores si ocurre un error de validación.

### `edit.blade.php`

Es parecido al formulario de creación, pero carga los valores existentes. Incluye:

```blade
@method('PUT')
```

Los formularios HTML no soportan directamente PUT, por eso Laravel utiliza esta directiva para simular el método HTTP.

### `show.blade.php`

Muestra el detalle completo de una tarea: título, descripción, estado, fechas, acciones y estadísticas.

## 11. Demostración práctica del funcionamiento

Graba estas acciones en orden:

1. Abre `http://127.0.0.1:8000`.
2. Muestra que la página inicial redirige al listado.
3. Pulsa **Nueva Tarea**.
4. Intenta guardar sin título y muestra el mensaje de validación.
5. Escribe un título y una descripción.
6. Pulsa **Guardar Tarea**.
7. Comprueba que la nueva tarea aparece en la tabla.
8. Pulsa el botón de ver detalles.
9. Pulsa **Editar Tarea**.
10. Cambia el texto y marca **Marcar como completada**.
11. Guarda y muestra que el estado cambió a completada.
12. Regresa al listado y verifica las estadísticas.
13. Elimina la tarea y confirma que desaparece.

Frase para explicar el resultado:

> En esta demostración se comprueba el ciclo completo CRUD: crear, leer, actualizar y eliminar. Los formularios están protegidos con CSRF y los datos se validan antes de guardarse.

