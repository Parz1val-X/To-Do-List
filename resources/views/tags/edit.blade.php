@extends('layouts.app')

@section('title', 'Editar etiqueta - To-Do List')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Editar etiqueta</h1>
        <a href="{{ route('tags.index') }}" class="btn btn-outline-secondary">Volver</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('tags.update', $tag) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $tag->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
@endsection