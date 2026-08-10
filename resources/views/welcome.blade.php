@extends('layouts.app')

@section('title', 'Inicio - To-Do List')

@section('content')
    <div class="p-5 mb-4 bg-white rounded-3 shadow-sm text-center">
        <h1 class="display-5 fw-bold">Bienvenido a tu To-Do List</h1>
        <p class="lead mb-0">
            Gestiona tus tareas organizándolas por categorías y etiquetas.
        </p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-list-check display-4 text-primary"></i>
                    <h5 class="card-title mt-3">Tareas</h5>
                    <p class="card-text">Crea, edita y completa tus tareas del día a día.</p>
                    <a href="{{ route('tasks.index') }}" class="btn btn-primary">Ir a Tareas</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-folder display-4 text-success"></i>
                    <h5 class="card-title mt-3">Categorías</h5>
                    <p class="card-text">Organiza tus tareas en grupos como trabajo o estudio.</p>
                    <a href="{{ route('categories.index') }}" class="btn btn-success">Ir a Categorías</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-tags display-4 text-warning"></i>
                    <h5 class="card-title mt-3">Etiquetas</h5>
                    <p class="card-text">Clasifica tus tareas con etiquetas flexibles.</p>
                    <a href="{{ route('tags.index') }}" class="btn btn-warning">Ir a Etiquetas</a>
                </div>
            </div>
        </div>
    </div>
@endsection