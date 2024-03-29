@extends('layouts.plantilla')

@section('title', "adminCategory")

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Categorías</h1>
    <div class="d-flex justify-content-between mb-2">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createCategoryModal"><i class="fas fa-plus"></i> Añadir categoría</button>
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
                        <a href="#editCategoryModal{{$category->id}}" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{$category->id}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('layouts.deleteCategory', $category->id) }}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('¿Seguro que quieres eliminar esta categoría?')"><i class="fas fa-trash"></i></button>
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
                    <h1 class="modal-title">Añadir categoría</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <form action="{{ route('layouts.createCategory') }}" method="POST">
                        @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                        <label for="name">Nombre de la categoría</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nombre de la categoria" class="form-control mb-2">

                        <button class="btn btn-secondary btn-block" type="submit" onclick="return confirm('¿Quieres crear la categoría?')">
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
                    <h2>Editando la categoría: {{ $category->name }}</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('layouts.updateCategory', $category->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                        <label for="name">Nombre de la categoría</label>
                        <input type="text" name="name" class="form-control mb-2" value="{{ $category->name }}"
                        placeholder="Nombre" autofocus>
                        <button class="btn btn-secondary btn-block" type="submit" onclick="return confirm('¿Quieres editar la categoria '+'{{ $category->name}}'+'?')">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach



@endsection

