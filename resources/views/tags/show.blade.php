@extends('layouts.app')

@section('title', $tag->name . ' - To-Do List')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">{{ $tag->name }}</h1>
        <div>
            <a href="{{ route('tags.edit', $tag) }}" class="btn btn-sm btn-outline-primary">Editar</a>
            <a href="{{ route('tags.index') }}" class="btn btn-sm btn-outline-secondary">Volver</a>
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
                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-outline-secondary">Ver</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection