@extends('layouts.plantilla')

@section('title', "Pedidos")

@section('content')


<div class="container mt-4">
    <h2>Id Pedido: xxx</h2>
    <!-- Tarjeta de pedido para el Producto 1 -->
    <div class="card pedido-card">
      <div class="card-body">
        <div class="row">
          <div class="col-3">
            <img src="/img/almacen-dia.png" alt="Producto 1" class="img-fluid pedido-img">
          </div>
          <div class="col-6">
            <h5 class="card-title">Producto 1</h5>
            <p class="card-text">Descripción</p>
          </div>
        </div>
      </div>
    </div>

        <!-- Tarjeta de pedido para el Producto 2 -->
        <div class="card pedido-card">
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <img src="/img/almacen-dia.png" alt="Producto 1" class="img-fluid pedido-img">
                </div>
                <div class="col-6">
                  <h5 class="card-title">Producto 2</h5>
                  <p class="card-text">Descripción</p>
                </div>
              </div>
            </div>
          </div>

              <!-- Tarjeta de pedido para el Producto 3 -->
    <div class="card pedido-card">
        <div class="card-body">
          <div class="row">
            <div class="col-3">
              <img src="/img/almacen-dia.png" alt="Producto 1" class="img-fluid pedido-img">
            </div>
            <div class="col-6">
              <h5 class="card-title">Producto 3</h5>
              <p class="card-text">Descripción</p>
            </div>
          </div>
        </div>
      </div>
    <div class="d-flex justify-content-end"> 
        <button class="btn btn-danger btn-sm mb-4"> 
            <i class="fas fa-trash-alt"></i> Cancelar pedido
        </button>
    </div>
    </div>
  
@endsection
