@extends('layouts.plantilla')

@section('title', "adminCategory")

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Categorías</h1>
    <div class="d-flex justify-content-between mb-2">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createCategoryModal">Añadir categoría</button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name}}</td>
                    <td>
                        <a href="#editCategoryModal{{$category->id}}" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{$category->id}}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('layouts.deleteCategory', $category->id) }}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

    <div class="modal fade" id="createCategoryModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Añadir Categoría</h1>
                    <button type="button" class="close" data-dismiss="modal">&times; </button>
                </div>
                
                <div class="modal-body">
                    <form action="{{ route('layouts.createCategory') }}" method="POST">
                        @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nombre de la categoria" class="form-control mb-2">

                        <button class="btn btn-primary btn-block" type="submit">
                            Crear nueva categoría
                        </button>

                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    @foreach ($categories as $category)
    <div class="modal fade" id="editCategoryModal{{$category->id}}">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Editando la nota {{ $category->name }}</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('layouts.updateCategory', $category->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                        <input type="text" name="name" class="form-control mb-2" value="{{ $category->name }}"
                        placeholder="Nombre" autofocus>
                        <button class="btn btn-secondary btn-block" type="submit">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="container mt-5">
        <!-- Título de la sección -->
        <h2 class="mb-4">Añadir y Eliminar Productos de Categorías</h2>
    
        <!-- Tabla de categorías con botones de añadir/eliminar -->
        <div class="table-responsive">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre de la Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#addProductsModal{{ $category->id }}">
                                Añadir/Eliminar Productos
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@foreach ($categories as $category)
<div class="modal fade" id="addProductsModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gestionar Productos en {{ $category->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="manageProductsForm{{ $category->id }}" method="POST" class="px-4 py-3">
                    @csrf
                    <label for="productSelect{{ $category->id }}" class="form-label">Selecciona los productos</label>
                    <select id="productSelect{{ $category->id }}" name="product_ids[]" class="form-select" multiple>
                        @foreach ($allProducts as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <!-- Botón para añadir productos a la categoría -->
                <div>
                    <button type="submit" form="manageProductsForm{{ $category->id }}" formaction="{{ route('category.addProducts', $category->id) }}" class="btn btn-secondary me-2">Añadir Seleccionados</button>
                    <!-- Botón para eliminar productos de la categoría -->
                    <button type="submit" form="manageProductsForm{{ $category->id }}" formaction="{{ route('category.removeProducts', $category->id) }}" class="btn btn-danger">Eliminar Seleccionados</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach


<div class="container">
    @foreach ($categories as $category)
        <h3 class="category-name">{{ $category->name }}</h3>
        <ul class="products-list">
            @foreach ($category->products as $product)
                <li>{{ $product->name }}</li>
            @endforeach
        </ul>
    @endforeach
</div>

@endsection

