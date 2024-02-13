@extends('layouts.plantilla')

@section('title', "Pedidos")

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
                    <button type="button" class="close" data-dismiss="modal">&times; </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('layouts.updateCategory', $category->id) }}" method="POST">
                        @method('PUT') {{-- Necesitamos cambiar al método PUT para editar --}}
                        @csrf
                        {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                        <input type="text" name="name" class="form-control mb-2" value="{{ $category->name }}"
                        placeholder="Nombre" autofocus>
                        <button class="btn btn-primary btn-block" type="submit">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection