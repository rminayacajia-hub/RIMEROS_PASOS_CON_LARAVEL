@extends('layout')

<!-- Sección del título de la página -->
@section('title', 'Editar Tarea')

<!-- Sección del contenido principal -->
@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto page-form">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Editar Tarea
                </h4>
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Actualiza la información y el estado actual de esta tarea.</p>
                <!-- Formulario para editar tarea -->
                <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
                    @csrf <!-- Token CSRF para seguridad -->
                    @method('PUT') <!-- Método HTTP PUT para actualización -->
                    
                    <!-- Campo: Título -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">
                            Título <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('titulo') is-invalid @enderror" 
                               id="titulo" 
                               name="titulo" 
                               value="{{ old('titulo', $tarea->titulo) }}"
                               placeholder="Ingresa el título de la tarea"
                               maxlength="255"
                               autofocus>
                        
                        <!-- Mensaje de error para el campo título -->
                        @error('titulo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        
                        <!-- Ayuda visual para el usuario -->
                        <small class="form-text text-muted">
                            El título es obligatorio y debe tener máximo 255 caracteres.
                        </small>
                    </div>

                    <!-- Campo: Descripción -->
                    <div class="mb-4">
                        <label for="descripcion" class="form-label">
                            <i class="fas fa-align-left me-1"></i>
                            Descripción
                        </label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                  id="descripcion" 
                                  name="descripcion" 
                                  rows="4"
                                  placeholder="Ingresa una descripción detallada de la tarea (opcional)">{{ old('descripcion', $tarea->descripcion) }}</textarea>
                        
                        <!-- Mensaje de error para el campo descripción -->
                        @error('descripcion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        
                        <!-- Ayuda visual para el usuario -->
                        <small class="form-text text-muted">
                            La descripción es opcional. Puedes modificar los detalles adicionales de la tarea.
                        </small>
                    </div>

                    <!-- Campo: Estado de completado -->
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="completada" 
                                   name="completada" 
                                   value="1"
                                   {{ $tarea->completada ? 'checked' : '' }}>
                            <label class="form-check-label" for="completada">
                                <i class="fas fa-check-circle me-1"></i>
                                Marcar como completada
                            </label>
                        </div>
                        <small class="form-text text-muted">
                            Marca esta opción si la tarea ha sido completada satisfactoriamente.
                        </small>
                    </div>

                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-between align-items-center form-actions">
                        <div>
                            <!-- Botón para enviar el formulario -->
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-2"></i>
                                Actualizar Tarea
                            </button>
                        </div>
                        
                        <div>
                            <!-- Botón para cancelar y volver al listado -->
                            <a href="{{ route('tareas.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>
                                Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Información de la tarea -->
        <div class="card mt-4 tips-card">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-info-circle me-2 text-info"></i>
                    Información de la Tarea
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>ID:</strong> {{ $tarea->id }}</p>
                        <p><strong>Creada:</strong> {{ $tarea->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Última actualización:</strong> {{ $tarea->updated_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Estado actual:</strong>
                            @if($tarea->completada)
                                <span class="badge bg-success">Completada</span>
                            @else
                                <span class="badge bg-warning">Pendiente</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection