@extends('layouts.plantilla')

@section('title', 'Editar Dirección')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Editar Dirección</h2>
    
    <form action="{{ route('addresses.update', $address->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="address" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $address->address }}" required>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Ciudad</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ $address->city }}" required>
        </div>

        <div class="mb-3">
            <label for="zip_code" class="form-label">Código Postal</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ $address->zip_code }}" required>
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">País</label>
            <input type="text" class="form-control" id="country" name="country" value="{{ $address->country }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Dirección</button>
    </form>
</div>
@endsection
