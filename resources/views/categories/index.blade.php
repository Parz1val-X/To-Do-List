@extends('layouts.app')

@section('title', 'Categorías - To-Do List')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Categorías</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Nueva categoría</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($categories->isEmpty())
                <p class="text-muted mb-0">No hay categorías todavía. ¡Crea la primera!</p>
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
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->tasks->count() }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-outline-secondary" title="Ver"><i class="bi bi-eye"></i></a>
                                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-primary" title="Editar"><i class="bi bi-pencil"></i></a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('¿Eliminar la categoría "{{ $category->name }}"?')">
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
        @if ($categories->hasPages())
            <div class="card-footer">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection
