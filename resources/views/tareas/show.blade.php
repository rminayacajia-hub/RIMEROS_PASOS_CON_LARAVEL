@extends('layout')

<!-- Sección del título de la página -->
@section('title', 'Detalles de Tarea')

<!-- Sección del contenido principal -->
@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <!-- Encabezado de la tarea con estado -->
            <div class="card-header {{ $tarea->completada ? 'bg-success' : 'bg-warning' }} text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">
                            <i class="fas fa-eye me-2"></i>
                            Detalles de la Tarea
                        </h4>
                        <p class="mb-0 opacity-75">
                            ID: {{ $tarea->id }}
                        </p>
                    </div>
                    <div>
                        @if($tarea->completada)
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-check-circle me-1"></i>
                                Completada
                            </span>
                        @else
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-clock me-1"></i>
                                Pendiente
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <!-- Información principal de la tarea -->
                <div class="mb-4">
                    <h3 class="h5 mb-3">
                        Título
                    </h3>
                    <p class="lead">{{ $tarea->titulo }}</p>
                </div>

                <!-- Despción de la tarea -->
                <div class="mb-4">
                    <h5 class="h6 mb-3">
                        <i class="fas fa-align-left me-2 text-info"></i>
                        Descripción
                    </h5>
                    @if($tarea->descripcion)
                        <div class="alert alert-info">
                            {{ nl2br(e($tarea->descripcion)) }}
                        </div>
                    @else
                        <div class="alert alert-light">
                            <i class="fas fa-info-circle me-2"></i>
                            No se ha proporcionado una descripción para esta tarea.
                        </div>
                    @endif
                </div>

                <!-- Fechas de la tarea -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">
                            <i class="fas fa-calendar-plus me-1"></i>
                            Fecha de Creación
                        </h6>
                        <p class="mb-0">
                            <strong>{{ $tarea->created_at->format('d/m/Y') }}</strong><br>
                            <small class="text-muted">{{ $tarea->created_at->format('H:i:s') }}</small>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">
                            <i class="fas fa-calendar-check me-1"></i>
                            Última Actualización
                        </h6>
                        <p class="mb-0">
                            <strong>{{ $tarea->updated_at->format('d/m/Y') }}</strong><br>
                            <small class="text-muted">{{ $tarea->updated_at->format('H:i:s') }}</small>
                        </p>
                    </div>
                </div>

                <!-- Estado de la tarea -->
                <div class="mb-4">
                    <h6 class="text-muted mb-2">
                        <i class="fas fa-tasks me-1"></i>
                        Estado Actual
                    </h6>
                    <div class="d-flex align-items-center">
                        @if($tarea->completada)
                            <div class="alert alert-success d-flex align-items-center" style="flex: 1;">
                                <i class="fas fa-check-circle fa-2x me-3"></i>
                                <div>
                                    <h6 class="mb-0">Completada</h6>
                                    <small class="mb-0">La tarea ha sido finalizada satisfactoriamente.</small>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning d-flex align-items-center" style="flex: 1;">
                                <i class="fas fa-clock fa-2x me-3"></i>
                                <div>
                                    <h6 class="mb-0">Pendiente</h6>
                                    <small class="mb-0">La tarea aún no ha sido completada.</small>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <!-- Botón para editar la tarea -->
                        <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>
                            Editar Tarea
                        </a>
                    </div>
                    
                    <div>
                        <!-- Botón para volver al listado -->
                        <a href="{{ route('tareas.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Volver al Listado
                        </a>
                        
                        <!-- Botón para eliminar la tarea -->
                        <form action="{{ route('tareas.destroy', $tarea->id) }}" 
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de eliminar esta tarea?');">
                                <i class="fas fa-trash me-2"></i>
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta con información adicional -->
        <div class="card mt-4">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-chart-bar me-2 text-primary"></i>
                    Estadísticas de la Tarea
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Tiempo de Existencia</h5>
                                {{-- Redondea el resultado para evitar mostrar muchos decimales. --}}
                                <h3 class="mb-0">{{ number_format($tarea->created_at->diffInDays(now()), 0, ',', '.') }}</h3>
                                <small>días</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5 class="card-title">Estado</h5>
                                <h3 class="mb-0">{{ $tarea->completada ? '100%' : '0%' }}</h3>
                                <small>completado</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">Última Modificación</h5>
                                {{-- Muestra las horas completas transcurridas, sin decimales. --}}
                                <h3 class="mb-0">{{ number_format($tarea->updated_at->diffInHours(now()), 0, ',', '.') }}</h3>
                                <small>horas atrás</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection