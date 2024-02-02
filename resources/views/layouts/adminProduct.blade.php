<!DOCTYPE html>
<html>

<head>
    @vite(['resources/js/app.js', 'resources/css/app.scss']) 
</head>


<body>
    <h1>Notas desde base de datos</h1>
    <a href="create_Product">Nueva nota</a>
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
                <td><a href="{{ route('product.update', $product) }}" class="btn btn-warning btn-sm"> Editar </a>
                </td>
                <td>
                    <form action="{{ route('product.delete', $product->id) }}" method="POST" class="d-inline">
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
