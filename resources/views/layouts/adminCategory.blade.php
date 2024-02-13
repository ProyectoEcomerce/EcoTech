@extends('layouts.plantilla')

@section('title', "Pedidos")

@section('content')
    <h1>Categorias</h1>
    <a href="#" data-bs-toggle="modal" data-bs-target="#createCategoryModal">Añadir categoría</a>
    <table border="1" class="table table-responsive">
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->name}}</td>
                <td><a href="#editCategoryModal{{$category->id}}" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{$category->id}}" class="btn btn-warning btn-sm"> Editar </a>
                </td>
                <td>
                    <form action="{{ route('layouts.deleteCategory', $category->id) }}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

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