@extends('layouts.app')

@section('title', 'Etiquetas - To-Do List')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Etiquetas</h1>
        <a href="{{ route('tags.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Nueva etiqueta</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($tags->isEmpty())
                <p class="text-muted mb-0">No hay etiquetas todavía. ¡Crea la primera!</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Tareas</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                                <tr>
                                    <td>{{ $tag->name }}</td>
                                    <td>{{ $tag->tasks->count() }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('tags.show', $tag) }}" class="btn btn-sm btn-outline-secondary" title="Ver"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('tags.edit', $tag) }}" class="btn btn-sm btn-outline-primary" title="Editar"><i class="bi bi-pencil"></i></a>
                                        <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('¿Eliminar la etiqueta "{{ $tag->name }}"?')">
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