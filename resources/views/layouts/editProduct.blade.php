<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <h2>Editando la nota {{ $product->id }}</h2>
    <form action="{{ route('layouts.updateProduct', $product->id) }}" method="POST">
        @method('PUT') {{-- Necesitamos cambiar al método PUT para editar --}}
        @csrf
        {{-- Cláusula para obtener un token de formulario al enviarlo --}}
        <input type="text" name="name" class="form-control mb-2" value="{{ $product->name }}"
        placeholder="Nombre" autofocus>
        <input type="text" name="price" class="form-control mb-2" value="{{ $product->price }}"
            placeholder="Precio" autofocus>
        <input type="text" name="offerPrice" placeholder="Precio oferta" class="form-control mb-2"
            value="{{ $product->offerPrice }}">
        <input type="text" name="voltage" class="form-control mb-2" value="{{ $product->voltage }}"
        placeholder="Voltage" autofocus>
        <input type="text" name="guarantee" class="form-control mb-2" value="{{ $product->guarantee }}"
        placeholder="Garantía" autofocus>
        <input type="text" name="manufacturing_price" class="form-control mb-2" value="{{ $product->manufacturing_price }}"
        placeholder="Manufactura" autofocus>
        <input type="text" name="weigth" class="form-control mb-2" value="{{ $product->weigth }}"
        placeholder="Peso" autofocus>
        <input type="text" name="materials" class="form-control mb-2" value="{{ $product->materials }}"
        placeholder="Materiales" autofocus>

        <input type="text" name="description" class="form-control mb-2" value="{{ $product->description }}"
        placeholder="Descripción" autofocus>

        <input type="text" name="dimensions" class="form-control mb-2" value="{{ $product->dimensions }}"
        placeholder="Dimensiones" autofocus>

        <input type="text" name="battery" class="form-control mb-2" value="{{ $product->battery }}"
        placeholder="Batería" autofocus>    
           
        <input type="text" name="engine" class="form-control mb-2" value="{{ $product->engine }}"
        placeholder="Motor" autofocus>

        <input type="text" name="components" class="form-control mb-2" value="{{ $product->components }}"
        placeholder="Componentes" autofocus>
        <button class="btn btn-primary btn-block" type="submit">Guardar cambios</button>
    </form>
</body>

</html>
