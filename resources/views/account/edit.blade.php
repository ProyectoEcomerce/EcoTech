@extends('layouts.plantilla')

@section('title', 'Cambiar Contraseña')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Cambiar Contraseña</h2>

    <form action="{{ route('account.updatePassword') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="current_password" class="form-label">Contraseña Actual</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label">Nueva Contraseña</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
    </form>
</div>
@endsection
