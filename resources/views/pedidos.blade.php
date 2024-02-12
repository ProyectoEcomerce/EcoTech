@extends('layouts.plantilla')

@section('title', "Pedidos")

@section('content')


<div class="container">
    <!-- Barra de búsqueda -->
    <div class="search-bar row">
      <div class="col">
        <input type="text" class="form-control search-input" placeholder="Año">
      </div>
      <div class="col">
        <input type="text" class="form-control search-input" placeholder="Mes">
      </div>
      <div class="col">
        <input type="text" class="form-control search-input" placeholder="Busqueda">
      </div>
    </div>

<!-- Estado del pedido 1 -->
<a href="cancelar-pedido.blade.php" class="text-decoration-none text-dark">
    <div class="order-status">
      <div class="row">
        <div class="col-md-3">
          <strong>Pedido 1</strong>
        </div>
        <div class="col-md-3">
          Estado: Por llegar
        </div>
        <div class="col-md-3">
          Fecha pedido: --/--/----
        </div>
        <div class="col-md-3">
          Fecha entrega: --/--/----
        </div>
      </div>
    </div>
  </a>
  
  <!-- Estado del pedido 2 -->
  <a href="cancelar-pedido.blade.php" class="text-decoration-none text-dark">
    <div class="order-status">
      <div class="row">
        <div class="col-md-3">
          <strong>Pedido 2</strong>
        </div>
        <div class="col-md-3">
          Estado: Por llegar
        </div>
        <div class="col-md-3">
          Fecha pedido: --/--/----
        </div>
        <div class="col-md-3">
          Fecha entrega: --/--/----
        </div>
      </div>
    </div>
  </a>
  
  <!-- Estado del pedido 3 -->
  <a href="cancelar-pedido.blade.php" class="text-decoration-none text-dark">
    <div class="order-status">
      <div class="row">
        <div class="col-md-3">
          <strong>Pedido 3</strong>
        </div>
        <div class="col-md-3">
          Estado: Por llegar
        </div>
        <div class="col-md-3">
          Fecha pedido: --/--/----
        </div>
        <div class="col-md-3">
          Fecha entrega: --/--/----
        </div>
      </div>
    </div>
  </a>
@endsection