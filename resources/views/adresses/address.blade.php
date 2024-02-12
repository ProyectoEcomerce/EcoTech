@extends('layouts.plantilla')

@section('title', "Direcciones")

@section('content')
<div class="container mt-5">
    <h2>Mis Direcciones</h2>
    
    <!-- Botón para añadir una nueva dirección -->
    <a href="{{ route('addresses.create') }}" class="btn btn-primary mb-3">Añadir Nueva Dirección</a>

    <div class="row">
        @forelse($addresses as $address)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $address->street }}, {{ $address->city }}</h5>
                        <p class="card-text">{{ $address->state }}, {{ $address->country }} - {{ $address->zip }}</p>
                        <!-- Botón para editar la dirección -->
                        <a href="{{ route('addresses.edit', $address->id) }}" class="btn btn-secondary">Editar</a>
                        <!-- Botón para borrar la dirección -->
                        <form action="{{ route('addresses.destroy', $address->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar esta dirección?')">Borrar</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No tienes direcciones guardadas.</p>
        @endforelse
    </div>
</div>
@endsection
