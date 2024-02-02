<!DOCTYPE html>
<html>

<head>

</head>

<body>

    <form action="{{ route('product.create') }}" method="POST">
        @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
        <input type="text" name="price" value="{{ old('price') }}" placeholder="Precio" class="form-control mb-2" autofocus>
        <input type="text" name="offerPrice" value="{{ old('offerPrice') }}" placeholder="Precio especial" class="form-control mb-2">
        <input type="text" name="voltage" value="{{ old('voltage') }}" placeholder="Voltage" class="form-control mb-2">
        <input type="text" name="guarantee" value="{{ old('guarantee') }}" placeholder="Garantía" class="form-control mb-2">
        <input type="text" name="manufacturing_price" value="{{ old('manufacturing_price') }}" placeholder="Precio de manufactura" class="form-control mb-2">
        <input type="text" name="weigth" value="{{ old('weigth') }}" placeholder="Peso" class="form-control mb-2">
        <input type="text" name="materials" value="{{ old('materials') }}" placeholder="Materiales" class="form-control mb-2">
        <input type="text" name="description" value="{{ old('description') }}" placeholder="Descripción" class="form-control mb-2">
        <input type="text" name="dimensions" value="{{ old('dimensions') }}" placeholder="Dimensiones" class="form-control mb-2">
        <input type="text" name="battery" value="{{ old('battery') }}" placeholder="Batería" class="form-control mb-2">
        <input type="text" name="engine" value="{{ old('engine') }}" placeholder="Motor" class="form-control mb-2">
        <input type="text" name="components" value="{{ old('components') }}" placeholder="Componentes" class="form-control mb-2">
        <button class="btn btn-primary btn-block" type="submit">
            Crear nuevo producto
        </button>
    </form>



</body>

</html>
