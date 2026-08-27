@extends('layout')

<!-- Sección del título de la página -->
@section('title', 'Nueva Tarea')

<!-- Sección del contenido principal -->
@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto page-form">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fas fa-plus me-2"></i>
                    Crear Nueva Tarea
                </h4>
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Define una tarea concreta y añade los detalles que necesites.</p>
                <!-- Formulario para crear nueva tarea -->
                <form action="{{ route('tareas.store') }}" method="POST">
                    @csrf <!-- Token CSRF para seguridad -->
                    
                    <!-- Campo: Título -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">
                            Título <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('titulo') is-invalid @enderror" 
                               id="titulo" 
                               name="titulo" 
                               value="{{ old('titulo') }}"
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
                                  placeholder="Ingresa una descripción detallada de la tarea (opcional)">{{ old('descripcion') }}</textarea>
                        
                        <!-- Mensaje de error para el campo descripción -->
                        @error('descripcion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        
                        <!-- Ayuda visual para el usuario -->
                        <small class="form-text text-muted">
                            La descripción es opcional. Puedes incluir detalles adicionales sobre la tarea.
                        </small>
                    </div>

                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-between align-items-center form-actions">
                        <div>
                            <!-- Botón para enviar el formulario -->
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Guardar Tarea
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

        <!-- Tips de ayuda -->
        <div class="card mt-4 tips-card">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-lightbulb me-2 text-warning"></i>
                    Consejos
                </h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-2"></i>
                        Sé específico con el título para que sea fácil de identificar
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-2"></i>
                        Incluye fechas límite o prioridades en la descripción si es necesario
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-2"></i>
                        Divide tareas grandes en tareas más pequeñas y manejables
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection