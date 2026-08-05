@extends('layouts.app')

@section('title', $task->title . ' - To-Do List')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">{{ $task->title }}</h1>
        <div>
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary">Editar</a>
            <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-outline-secondary">Volver</a>
        </div>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <p class="mb-1"><strong>Estado:</strong>
                @if ($task->completed)
                    <span class="badge bg-success">Completada</span>
                @else
                    <span class="badge bg-secondary">Pendiente</span>
                @endif
            </p>
            <p class="mb-1"><strong>Categoría:</strong>
                @if ($task->category)
                    <a href="{{ route('categories.show', $task->category) }}">{{ $task->category->name }}</a>
                @else
                    —
                @endif
            </p>
            <p class="mb-1"><strong>Etiquetas:</strong>
                @forelse ($task->tags as $tag)
                    <a href="{{ route('tags.show', $tag) }}" class="badge bg-info text-dark text-decoration-none">{{ $tag->name }}</a>
                @empty
                    <span class="text-muted">—</span>
                @endforelse
            </p>
            @if ($task->description)
                <hr>
                <p class="mb-0">{{ $task->description }}</p>
            @endif
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                onsubmit="return confirm('¿Eliminar la tarea "{{ $task->title }}"?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Eliminar tarea</button>
            </form>
        </div>
    </div>
@endsection