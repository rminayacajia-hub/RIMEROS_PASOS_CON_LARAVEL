@extends('layout')

<!-- Sección del título de la página -->
@section('title', 'Lista de Tareas')

<!-- Sección del contenido principal -->
@section('content')
<div class="row">
    <div class="col-12">
        <!-- Encabezado de la página -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0">
                    <i class="fas fa-list me-2 text-primary"></i>
                    Mis Tareas
                </h1>
                <p class="text-muted">Gestiona tus tareas diarias de manera eficiente</p>
            </div>
            <a href="{{ route('tareas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Nueva Tarea
            </a>
        </div>

        <!-- Estadísticas de tareas -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Tareas</h5>
                        <h2 class="mb-0">{{ $tareas->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Completadas</h5>
                        <h2 class="mb-0">{{ $tareas->where('completada', true)->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Pendientes</h5>
                        <h2 class="mb-0">{{ $tareas->where('completada', false)->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body text-center">
                        <h5 class="card-title">Porcentaje</h5>
                        <h2 class="mb-0">{{ round(($tareas->where('completada', true)->count() / max(1, $tareas->count())) * 100) }}%</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de tareas -->
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-clipboard-list me-2"></i>
                    Todas las Tareas
                </h5>
            </div>
            <div class="card-body">
                @if($tareas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Creada</th>
                                    <th scope="col" class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tareas as $tarea)
                                    <tr class="{{ $tarea->completada ? 'completed' : '' }}">
                                        <th scope="row">{{ $tarea->id }}</th>
                                        <td>
                                            <strong class="task-title">{{ Str::limit($tarea->titulo, 50) }}</strong>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ Str::limit($tarea->descripcion, 100) }}</small>
                                        </td>
                                        <td>
                                            @if($tarea->completada)
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check me-1"></i>
                                                    Completada
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Pendiente
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $tarea->created_at->format('d/m/Y H:i') }}
                                            </small>
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('tareas.show', $tarea->id) }}" 
                                                   class="btn btn-sm btn-outline-primary"
                                                   title="Ver detalles">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('tareas.edit', $tarea->id) }}" 
                                                   class="btn btn-sm btn-outline-warning"
                                                   title="Editar tarea">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('tareas.destroy', $tarea->id) }}" 
                                                      method="POST"
                                                      onsubmit="return confirm('¿Estás seguro de eliminar esta tarea?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger"
                                                            title="Eliminar tarea">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <!-- Mensaje cuando no hay tareas -->
                    <div class="text-center py-5">
                        <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No hay tareas registradas</h4>
                        <p class="text-muted">Comienza creando tu primera tarea para organizar tus actividades.</p>
                        <a href="{{ route('tareas.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>
                            Crear Primera Tarea
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection