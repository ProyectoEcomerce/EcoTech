@extends('layouts.plantilla')

@section('title', "Inicio")

@section('content')
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="/img/almacen-dia.png" class="d-block w-100" alt="imagen1-carousel">
        <div class="carousel-caption d-none d-md-block">
          <h5>TEXTO</h5>
          <p>TEXTO</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="/img/fabrica-noche.png" class="d-block w-100" alt="imagen2-carousel">
        <div class="carousel-caption d-none d-md-block">
          <h5>TEXTO</h5>
          <p>TEXTO</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="/img/oficina-dia.png" class="d-block w-100" alt="imagen3-carousel">
        <div class="carousel-caption d-none d-md-block">
          <h5>TEXTO</h5>
          <p>TEXTO</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

<!-- Sección de Productos -->
<div class="container my-4">
    <h2 class="mb-4">Nuestros Productos</h2>
    <div class="row g-4">
        <!-- Producto 1 -->
        <div class="col-12 col-md-4">
            <div class="card">
                <img src="/img/fabrica-noche.png" class="card-img-top" alt="Producto 1">
                <div class="card-body">
                    <h5 class="card-title">Producto 1</h5>
                    <p class="card-text">Descripción breve del producto 1.</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="button">Agregar a la cesta</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Producto 2 -->
        <div class="col-12 col-md-4">
            <div class="card">
                <img src="/img/oficina-dia.png" class="card-img-top" alt="Producto 2">
                <div class="card-body">
                    <h5 class="card-title">Producto 2</h5>
                    <p class="card-text">Descripción breve del producto 2.</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="button">Agregar a la cesta</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Producto 3 -->
        <div class="col-12 col-md-4">
            <div class="card">
                <img src="/img/almacen-dia.png" class="card-img-top" alt="Producto 3">
                <div class="card-body">
                    <h5 class="card-title">Producto 3</h5>
                    <p class="card-text">Descripción breve del producto 3.</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="button">Agregar a la cesta</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <img src="/img/fabrica-noche.png" class="card-img-top" alt="Producto 1">
                <div class="card-body">
                    <h5 class="card-title">Producto 1</h5>
                    <p class="card-text">Descripción breve del producto 1.</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="button">Agregar a la cesta</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Producto 2 -->
        <div class="col-12 col-md-4">
            <div class="card">
                <img src="/img/oficina-dia.png" class="card-img-top" alt="Producto 2">
                <div class="card-body">
                    <h5 class="card-title">Producto 2</h5>
                    <p class="card-text">Descripción breve del producto 2.</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="button">Agregar a la cesta</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Producto 3 -->
        <div class="col-12 col-md-4">
            <div class="card">
                <img src="/img/almacen-dia.png" class="card-img-top" alt="Producto 3">
                <div class="card-body">
                    <h5 class="card-title">Producto 3</h5>
                    <p class="card-text">Descripción breve del producto 3.</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="button">Agregar a la cesta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


  <!-- Botón para abrir el sidebar -->
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#shoppingCart" aria-controls="shoppingCart">
    <i class="fas fa-shopping-cart"></i> Cesta
</button>

<!-- Sidebar para la cesta de compra -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="shoppingCart" aria-labelledby="shoppingCartLabel">
    <div class="offcanvas-header">
        <h5 id="shoppingCartLabel">Cesta de Compra</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <!-- Contenido de la cesta de compra aquí -->
        <p>Aquí van los artículos de tu cesta.</p>
    </div>
</div>

  
@endsection