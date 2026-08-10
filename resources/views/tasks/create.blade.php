@extends('layouts.app')

@section('title', 'Nueva tarea - To-Do List')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Nueva tarea</h1>
        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Categoría</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                        <option value="">Sin categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Etiquetas</label>
                    <div>
                        @forelse ($tags as $tag)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                    id="tag-{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                            </div>
                        @empty
                            <p class="text-muted mb-0">
                                No hay etiquetas. <a href="{{ route('tags.create') }}">Crea una</a>.
                            </p>
                        @endforelse
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input class="form-check-input @error('completed') is-invalid @enderror" type="checkbox"
                        id="completed" name="completed" value="1" {{ old('completed') ? 'checked' : '' }}>
                    <label class="form-check-label" for="completed">Completada</label>
                </div>

                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Guardar</button>
            </form>
        </div>
    </div>
@endsection