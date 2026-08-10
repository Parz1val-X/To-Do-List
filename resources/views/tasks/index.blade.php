@extends('layouts.app')

@section('title', 'Tareas - To-Do List')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Tareas</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Nueva tarea</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($tasks->isEmpty())
                <p class="text-muted mb-0">No hay tareas todavía. ¡Crea la primera!</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Categoría</th>
                                <th>Etiquetas</th>
                                <th>Estado</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->category ? $task->category->name : '—' }}</td>
                                    <td>
                                        @forelse ($task->tags as $tag)
                                            <span class="badge bg-info text-dark">{{ $tag->name }}</span>
                                        @empty
                                            <span class="text-muted">—</span>
                                        @endforelse
                                    </td>
                                    <td>
                                        @if ($task->completed)
                                            <span class="badge bg-success">Completada</span>
                                        @else
                                            <span class="badge bg-secondary">Pendiente</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-outline-secondary" title="Ver"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary" title="Editar"><i class="bi bi-pencil"></i></a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('¿Eliminar la tarea "{{ $task->title }}"?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection