@extends('layouts.plantilla')

@section('title', 'Perfil')


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
<main>
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-head">
                <div class="row product_data">
                    <h4>Mi lista de deseos</h4>
                </div>
            </div>
            <div class="card-body">
                @foreach ($products as $product )
                    <div class="row product_data pb-3">
                        <div class="col-md-2 my-auto">
                            <h6>{{$product->name}}</h6>
                        </div>
                        <div class="col-md-2 my-auto">
                            <h6>{{$product->price}}</h6>
                        </div>
                        <div class="col-md-2 my-auto">
                            <a href="{{route('show.item', $product->id)}}" class="btn btn-primary" id="boton-card" role="button">{{__("Ver producto")}}</a>
                        </div>
                        <div class="col-md-2 my-auto">
                            <form action="{{ route('wish.additem') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-primary">{{__("Quitar de la lista")}}</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection