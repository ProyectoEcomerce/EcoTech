@extends('layouts.plantilla')

@section('title', 'Añadir Nueva Dirección')

@section('content')
<div class="container mt-5">
    <h2>Añadir Nueva Dirección</h2>
    
    <form action="{{ route('addresses.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="address" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Ciudad</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>

        <div class="mb-3">
            <label for="zip_code" class="form-label">Código Postal</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code" required>
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">País</label>
            <input type="text" class="form-control" id="country" name="country" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Dirección</button>
    </form>
</div>
@endsection
