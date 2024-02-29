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
    @foreach ($carouselProducts as $carouselProduct)
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-label="Slide {{ $loop->index + 1 }}"></button>
     @endforeach
  </div>

    <div class="carousel-inner">
      @foreach ($carouselProducts as $carouselProduct)
      <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
        <a href="{{route('show.item', $carouselProduct->id)}}">
        @php
          $images = $carouselProduct->image;
        @endphp
        @foreach($images->take(1) as $img)
            <img class="d-block w-auto h-auto carousel-image" src="{{ asset($img->product_photo) }}" alt="{{ $carouselProduct->name }}">
        @endforeach
        <div class="carousel-caption d-none d-md-block" >
          
          <h5>{{$carouselProduct->name}}</h5>
          @foreach ($offers as $offer)
            @if ($offer->product->contains($carouselProduct->id))
              <p>Precio con descuento: {{number_format($carouselProduct->price - ($carouselProduct->price * $offer->discount / 100), 2)}}€</p>
              @else 
                @foreach ($carouselProduct->categories as $category)
                    @if ($offer->category->contains($category->id))
                        <p>Precio con descuento: {{ number_format($carouselProduct->price - ($carouselProduct->price * $offer->discount / 100), 2) }}€</p>
                        @break
                    @endif
                @endforeach
              @endif
          @endforeach
          <p>{{$carouselProduct->price}}€</p>
        </div>
        </a> 
      </div>
      @endforeach
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
        @if($product->show)
          <div class="col-12 col-md-4">
              <div class="card">
                @php
                    // Obtener todas las imágenes para este producto
                    $images = $product->image;
                @endphp
                @foreach ($images->take(1) as $img)
                    <!-- Cogemos solo la 1º imagen -->
                    <img class="card-img-top img-fluid" src="{{ asset($img->product_photo) }}" alt="{{ $product->name }}">
                @endforeach
                  <div class="card-body">
                      <h5 class="card-title">{{ $product->name }}</h5>
                      <p class="card-text">{{ substr($product->description,0,120) }}...</p>
                    @foreach ($offers as $offer)
                      @if ($offer->product->contains($product->id))
                          <p>Precio con descuento: {{ number_format($product->price - ($product->price * $offer->discount / 100),2) }}€</p>
                      @else 
                          @foreach ($product->categories as $category)
                              @if ($offer->category->contains($category->id))
                                  <p>Precio con descuento: {{ number_format($product->price - ($product->price * $offer->discount / 100), 2) }}€</p>
                                  @break
                              @endif
                          @endforeach
                      @endif
                    @endforeach

                      <p class="card-text">{{ $product->price }}€</p>
                      <div class="d-grid gap-2 pb-1">
                          <a href="{{route('show.item', $product->id)}}" class="btn btn-primary" id="boton-card" role="button">{{__("Ver producto")}}</a>
                      </div>
                      @auth
                      <div class="d-flex">
                        <div class="m-auto">
                          <form action="{{ route('cart.additem') }}" method="POST">
                              @csrf
                              <input type="hidden" name="product_id" value="{{ $product->id }}">
                              <button type="submit" class="btn btn-primary"><i class="fas fa-cart-plus"></i></button>
                          </form>
                        </div>
                        <div class="m-auto">
                          <form action="{{ route('wish.additem') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            @if(auth()->user()->wishlist)
                              @if(auth()->user()->wishlist->product->contains($product->id))
                                <button type="submit" class="btn btn-primary"><i class="fas fa-heart"></i></button>
                              @else
                                <button type="submit" class="btn btn-primary"><i class="far fa-heart"></i></button>
                              @endif
                            @endif
                          </form>
                        </div>
                      </div>
                      @else
                          <p>@lang('messages.login_required',['login' => route('login')])</p>
                      @endauth
                  </div>
              </div>
          </div>
          @endif
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
      {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>
</main>
@endsection