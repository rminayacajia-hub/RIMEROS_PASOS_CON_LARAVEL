<?php

namespace Tests\Feature;

// Importa el modelo usado para preparar y verificar registros.
use App\Models\Tarea;
// Reinicia la base de datos SQLite antes de cada prueba.
use Illuminate\Foundation\Testing\RefreshDatabase;
// Usa la configuración común de pruebas de Laravel.
use Tests\TestCase;

class TareaCrudTest extends TestCase
{
    // Ejecuta las migraciones en una base de datos aislada para cada prueba.
    use RefreshDatabase;

    public function test_puede_listar_tareas(): void
    {
        // Crea datos de prueba para comprobar que aparecen en el listado.
        $tarea = Tarea::create([
            'titulo' => 'Preparar informe',
            'descripcion' => 'Revisar los datos del mes.',
        ]);

        // Solicita la ruta y verifica respuesta, título y descripción.
        $this->get(route('tareas.index'))
            ->assertOk()
            ->assertSee($tarea->titulo)
            ->assertSee($tarea->descripcion);
    }

    public function test_puede_crear_una_tarea(): void
    {
        // Envía los datos como lo haría el formulario de creación.
        $respuesta = $this->post(route('tareas.store'), [
            'titulo' => 'Comprar material',
            'descripcion' => 'Comprar cuadernos.',
        ]);

        $respuesta->assertRedirect(route('tareas.index'));
        // Confirma que Laravel guardó los datos y aplicó false por defecto.
        $this->assertDatabaseHas('tareas', [
            'titulo' => 'Comprar material',
            'descripcion' => 'Comprar cuadernos.',
            'completada' => false,
        ]);
    }

    public function test_el_titulo_es_obligatorio(): void
    {
        // Comprueba que una petición sin título vuelve al formulario con error.
        $this->from(route('tareas.create'))
            ->post(route('tareas.store'), ['descripcion' => 'Sin título'])
            ->assertRedirect(route('tareas.create'))
            ->assertSessionHasErrors('titulo');
    }

    public function test_puede_mostrar_y_actualizar_una_tarea_incluido_su_estado(): void
    {
        // Prepara una tarea pendiente para probar consulta y actualización.
        $tarea = Tarea::create(['titulo' => 'Tarea original']);

        $this->get(route('tareas.show', $tarea))
            ->assertOk()
            ->assertSee($tarea->titulo);

        // Actualiza los campos, incluido el estado enviado por el checkbox.
        $this->put(route('tareas.update', $tarea), [
            'titulo' => 'Tarea actualizada',
            'descripcion' => 'Descripción actualizada.',
            'completada' => true,
        ])->assertRedirect(route('tareas.index'));

        // Verifica que todos los cambios llegaron a la base de datos.
        $this->assertDatabaseHas('tareas', [
            'id' => $tarea->id,
            'titulo' => 'Tarea actualizada',
            'descripcion' => 'Descripción actualizada.',
            'completada' => true,
        ]);
    }

    public function test_puede_eliminar_una_tarea(): void
    {
        // Crea un registro que será eliminado durante la prueba.
        $tarea = Tarea::create(['titulo' => 'Tarea temporal']);

        // Envía la petición DELETE a la ruta resource correspondiente.
        $this->delete(route('tareas.destroy', $tarea))
            ->assertRedirect(route('tareas.index'));

        // Confirma que el registro ya no existe.
        $this->assertDatabaseMissing('tareas', ['id' => $tarea->id]);
    }
}
