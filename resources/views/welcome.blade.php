@extends('layouts.plantilla')

@section('title', "Inicio")
<main>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="shoppingCart" aria-labelledby="shoppingCartLabel">
        <div class="offcanvas-header">
            <h5 id="shoppingCartLabel">{{__("Carrito de compra")}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          @auth
          @include('partials.cart')
          @else
          <!--Para la traducción, en caso de no ser puras cadenas de texto usar variables (Vease rutas, variables php...)-->
          <p>@lang('messages.login_required',['login' => route('login')])</p>
          @endauth
        </div>
    </div>
    
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
    <h2 class="display-4">{{__('Descubre Nuestros Productos')}}</h2>
    <p class="lead text-muted">{{__("La mejor selección para tus necesidades")}}</p>    
    <div class="row g-4">
        @foreach ($products as $product)
          <div class="col-12 col-md-4">
              <div class="card">
                  <img class="card-img-top" src="{{ $product->image_url }}" alt="{{ $product->name }}">
                  <div class="card-body">
                      <h5 class="card-title">{{ $product->name }}</h5>
                      <p class="card-text">{{ $product->description }}</p>
                      <p class="card-text">{{ $product->price }}€</p>
                      <div class="d-grid gap-2">
                          <a href="{{route('show.item', $product->id)}}" class="btn btn-primary" id="boton-card" role="button">{{__("Ver producto")}}</a>
                      </div>
                      @auth
                          <form action="{{ route('cart.additem') }}" method="POST">
                              @csrf
                              <input type="hidden" name="product_id" value="{{ $product->id }}">
                              <button type="submit" class="btn btn-primary">{{__("Añadir al Carrito")}}</button>
                          </form>
                          <form action="{{ route('wish.additem') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-primary">{{__("Añadir al Carrito")}}</button>
                          </form>
                      @else
                          <p>@lang('messages.login_required',['login' => route('login')])</p>
                      @endauth
                  </div>
              </div>
          </div>
        @endforeach
    </div>
</div>
</main>
@endsection