<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Pedido</title>
</head>
<body>
    <h1>Hola, {{ $user->name }}</h1>
    <p>Tu pedido ha sido confirmado con éxito. Aquí están los detalles:</p>
    <ul>
        @foreach($products as $product)
            <li>{{ $product->name }} - {{ $product->price }}€</li>
        @endforeach
    </ul>
    <p>Gracias por tu compra.</p>
</body>
</html>
