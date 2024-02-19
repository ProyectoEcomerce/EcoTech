@extends('layouts.plantilla')

@section('title', "adminCategory")

@section('content')

<main>
    <div class="container mt-4 mb-4">
        <h2 class="text-center mb-4">{{ __('Productos y Categorías') }}</h2>
        <div class="row row-cols-1 row-cols-md-2 g-2">
            
            <!-- Prodcutos -->
            <div class="col">
                <a href="{{ route('admin.product') }}" class="card-link text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-box"></i> {{ __('Productos') }}</h5>
                            <p class="card-text">{{ __('Gestión, creación, actualización y eliminación de productos') }}</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Categorias -->
            <div class="col">
                <a href="{{ route('admin.category') }}" class="card-link text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-list"></i> {{ __('Categorías') }}</h5>
                            <p class="card-text">{{ __('Gestión, creación, actualización y eliminación de categorías') }}</p>
                        </div>
                    </div>
                </a>
            </div>
            </main>

@endsection