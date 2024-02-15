@extends('layouts.plantilla')

@section('title', 'adminProduct')
@section('content')
    <h1 class="text-center">Productos</h1>
    <div class="d-flex justify-content-center">
        <a href="#" data-bs-toggle="modal" data-bs-target="#createProductModal" class="btn btn-success mb-5">Añadir
            producto</a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Precio oferta</th>
                <th>Voltage</th>
                <th>Garantía</th>
                <th>Precio manufactura</th>
                <th>Peso</th>
                <th>Materiales</th>
                <th>Descripción</th>
                <th>Dimensiones</th>
                <th>Batería</th>
                <th>Motor</th>
                <th>Componentes</th>
            </tr>
        </thead>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->offerPrice }}</td>
                <td>{{ $product->voltage }}</td>
                <td>{{ $product->guarantee }}</td>
                <td>{{ $product->manufacturing_price }}</td>
                <td>{{ $product->weigth }}</td>
                <td>{{ $product->materials }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->dimensions }}</td>
                <td>{{ $product->battery }}</td>
                <td>{{ $product->engine }}</td>
                <td>{{ $product->components }}</td>
                <td><a href="#editProductModal{{ $product->id }}" data-bs-toggle="modal"
                        data-bs-target="#editProductModal{{ $product->id }}" class="btn btn-warning btn-sm"> Editar </a>
                </td>
                <td>
                    <form action="{{ route('layouts.deleteProduct', $product->id) }}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    </div>
    <div class="modal fade" id="createProductModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Añadir Producto</h1>
                    <button type="button" class="close" data-dismiss="modal">&times; </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('layouts.createProduct') }}" method="POST" enctype="multipart/form-data">
                        @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nombre del producto"
                            class="form-control mb-2">
                        <input type="text" name="price" value="{{ old('price') }}" placeholder="Precio"
                            class="form-control mb-2" autofocus>
                        <input type="text" name="offerPrice" value="{{ old('offerPrice') }}"
                            placeholder="Precio especial" class="form-control mb-2">
                        <input type="text" name="voltage" value="{{ old('voltage') }}" placeholder="Voltage"
                            class="form-control mb-2">
                        <input type="text" name="guarantee" value="{{ old('guarantee') }}" placeholder="Garantía"
                            class="form-control mb-2">
                        <input type="text" name="manufacturing_price" value="{{ old('manufacturing_price') }}"
                            placeholder="Precio de manufactura" class="form-control mb-2">
                        <input type="text" name="weigth" value="{{ old('weigth') }}" placeholder="Peso"
                            class="form-control mb-2">
                        <input type="text" name="materials" value="{{ old('materials') }}" placeholder="Materiales"
                            class="form-control mb-2">
                        <input type="text" name="description" value="{{ old('description') }}" placeholder="Descripción"
                            class="form-control mb-2">
                        <input type="text" name="dimensions" value="{{ old('dimensions') }}" placeholder="Dimensiones"
                            class="form-control mb-2">
                        <input type="text" name="battery" value="{{ old('battery') }}" placeholder="Batería"
                            class="form-control mb-2">
                        <input type="text" name="engine" value="{{ old('engine') }}" placeholder="Motor"
                            class="form-control mb-2">
                        <input type="text" name="components" value="{{ old('components') }}" placeholder="Componentes"
                            class="form-control mb-2">
                        <input type="file" name="image[]" accept="image/" class="form-control mb-2" multiple>
                        <button class="btn btn-primary btn-block" type="submit">
                            Crear nuevo producto
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($products as $product)
        <div class="modal fade" id="editProductModal{{ $product->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Editando la nota {{ $product->name }}</h2>
                        <button type="button" class="close" data-dismiss="modal">&times; </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('layouts.updateProduct', $product->id) }}" method="POST">
                            @method('PUT') {{-- Necesitamos cambiar al método PUT para editar --}}
                            @csrf
                            {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                            <input type="text" name="name" class="form-control mb-2" value="{{ $product->name }}"
                                placeholder="Nombre" autofocus>
                            <input type="text" name="price" class="form-control mb-2"
                                value="{{ $product->price }}" placeholder="Precio" autofocus>
                            <input type="text" name="offerPrice" placeholder="Precio oferta"
                                class="form-control mb-2" value="{{ $product->offerPrice }}">
                            <input type="text" name="voltage" class="form-control mb-2"
                                value="{{ $product->voltage }}" placeholder="Voltage" autofocus>
                            <input type="text" name="guarantee" class="form-control mb-2"
                                value="{{ $product->guarantee }}" placeholder="Garantía" autofocus>
                            <input type="text" name="manufacturing_price" class="form-control mb-2"
                                value="{{ $product->manufacturing_price }}" placeholder="Manufactura" autofocus>
                            <input type="text" name="weigth" class="form-control mb-2"
                                value="{{ $product->weigth }}" placeholder="Peso" autofocus>
                            <input type="text" name="materials" class="form-control mb-2"
                                value="{{ $product->materials }}" placeholder="Materiales" autofocus>

                            <input type="text" name="description" class="form-control mb-2"
                                value="{{ $product->description }}" placeholder="Descripción" autofocus>

                            <input type="text" name="dimensions" class="form-control mb-2"
                                value="{{ $product->dimensions }}" placeholder="Dimensiones" autofocus>

                            <input type="text" name="battery" class="form-control mb-2"
                                value="{{ $product->battery }}" placeholder="Batería" autofocus>

                            <input type="text" name="engine" class="form-control mb-2"
                                value="{{ $product->engine }}" placeholder="Motor" autofocus>

                            <input type="text" name="components" class="form-control mb-2"
                                value="{{ $product->components }}" placeholder="Componentes" autofocus>
                            <button class="btn btn-primary btn-block" type="submit">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
