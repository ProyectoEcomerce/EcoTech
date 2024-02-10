@extends('layouts.plantilla')

@section('title', 'perfil')

@section('content')
    <main>
        <div class="container mt-4 mb-4">
            <h2 class="text-center mb-4">Mi cuenta</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Mis pedidos -->
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-box"></i> Mis pedidos</h5>
                            <p class="card-text">Devolver, cancelar un pedido o descargar la factura o ticket</p>
                        </div>
                    </div>
                </div>


                <!-- Direcciones -->
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-map-marker-alt"></i> Direcciones</h5>
                            <p class="card-text">Editar, eliminar o añadir direcciones</p>
                        </div>
                    </div>
                </div>

                <!-- Edicón de cuenta -->
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-lock"></i> Editar mi cuenta</h5>
                            <p class="card-text">Cambiar la contraseña</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
