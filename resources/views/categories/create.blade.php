@extends('layouts.app')

@section('title', 'Nueva categoría - To-Do List')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Nueva categoría</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Guardar</button>
            </form>
        </div>
    </div>
@endsection
