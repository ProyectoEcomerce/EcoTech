@extends('layouts.plantilla')

@section('title', "Productos")

@section('content')

<div class="offcanvas offcanvas-end" tabindex="-1" id="shoppingCart" aria-labelledby="shoppingCartLabel">
    <div class="offcanvas-header">
        <h5 id="shoppingCartLabel">Cesta de Compra</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <!-- Contenido de la cesta de compra aquí -->
        @include('partials.cart')
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center mb-4">
        <div class="col-lg-6 col-md-12">
            <div class="card border-0">
                @foreach($product->image()->paginate(1) as $img)
                <img class="card-img-top img-fluid" src="{{ asset($img->product_photo) }}" alt="{{ $product->name }}">
                @endforeach
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card bg-light border-0">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{$product->price}}€</p>
                    <p class="card-text">{{$product->description}}</p>
                    @auth
                    <form action="{{ route('cart.additem') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" id="boton-card" type="submit">Agregar a la cesta</button>
                        </div>
                    </form>
                    @else
                        <p>Necesitas <a href="{{ route('login') }}">iniciar sesión</a> para añadir productos al
                            carrito.</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card border-0">
                <div class="card-body">
                    <h5 class="card-title">Especificaciones</h5>
                    <p class="card-text">{{$product->voltage}}</p>
                    <p class="card-text">{{$product->guarantee}}</p>
                    <p class="card-text">{{$product->manufacturing_price}}</p>
                    <p class="card-text">{{$product->weigth}}</p>
                    <p class="card-text">{{$product->materials}}</p>
                    <p class="card-text">{{$product->dimensions}}</p>
                    <p class="card-text">{{$product->battery}}</p>
                    <p class="card-text">{{$product->engine}}</p>
                    <p class="card-text">{{$product->components}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
