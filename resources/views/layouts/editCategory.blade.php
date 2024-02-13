<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <h2>Editando la nota {{ $category->id }}</h2>
    <form action="{{ route('layouts.updateCategory', $category->id) }}" method="POST">
        @method('PUT') {{-- Necesitamos cambiar al método PUT para editar --}}
        @csrf
        {{-- Cláusula para obtener un token de formulario al enviarlo --}}
        <input type="text" name="name" class="form-control mb-2" value="{{ $category->name }}"
        placeholder="Nombre" autofocus>
        <button class="btn btn-primary btn-block" type="submit">Guardar cambios</button>
    </form>
</body>

</html>
