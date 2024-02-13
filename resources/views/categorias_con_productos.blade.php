@extends('layouts.app') {{-- Asume que tienes un layout base --}}

@section('content')
<div class="container">
    <h1>Categorías y sus Productos</h1>
    @foreach ($categories as $category)
        <div class="categoria">
            <h2>{{ $category->name }}</h2>
            <ul>
                @foreach ($category->products as $product)
                    <li>{{ $product->name }}</li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
@endsection