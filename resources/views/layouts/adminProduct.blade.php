<!DOCTYPE html>
<html>

<head>
    @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js'])
</head>


<body>
    <h1>Productos</h1>
    <a href="create_Product">añadir producto</a>
    <table border="1" class="table table-responsive">
        <thead>
            <tr>
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
                <td>{{ $product->price}}</td>
                <td>{{ $product->offerPrice}}</td>
                <td>{{ $product->voltage}}</td>
                <td>{{ $product->guarantee}}</td>
                <td>{{ $product->manufacturing_price}}</td>
                <td>{{ $product->weigth}}</td>
                <td>{{ $product->materials}}</td>
                <td>{{ $product->description}}</td>
                <td>{{ $product->dimensions}}</td>
                <td>{{ $product->battery}}</td>
                <td>{{ $product->engine}}</td>
                <td>{{ $product->components}}</td>
                <td><a href="{{ route('layouts.editProduct', $product->id) }}" class="btn btn-warning btn-sm"> Editar </a>
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
</body>

</html>
