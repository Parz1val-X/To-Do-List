@extends('layouts.app')

@section('title', $tag->name . ' - To-Do List')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">{{ $tag->name }}</h1>
        <div>
            <a href="{{ route('tags.edit', $tag) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i> Editar</a>
            <a href="{{ route('tags.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
        </div>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <p class="mb-1"><strong>Tareas asociadas:</strong> {{ $tasks->count() }}</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">Tareas con esta etiqueta</div>
        <div class="card-body">
            @if ($tasks->isEmpty())
                <p class="text-muted mb-0">Esta etiqueta no tiene tareas.</p>
            @else
                <ul class="list-group">
                    @foreach ($tasks as $task)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                {{ $task->title }}
                                @if ($task->completed)
                                    <span class="badge bg-success">Completada</span>
                                @else
                                    <span class="badge bg-secondary">Pendiente</span>
                                @endif
                            </span>
                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="card shadow-sm mt-3">
        <div class="card-body">
            <form action="{{ route('tags.destroy', $tag) }}" method="POST"
                onsubmit="return confirm('¿Eliminar la etiqueta "{{ $tag->name }}"?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash"></i> Eliminar etiqueta</button>
            </form>
        </div>
    </div>
@endsection