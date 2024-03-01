<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Pedido</title>
</head>
<body>
    <div class="container">
        <h1>Confirmación de Pedido</h1>
        <p>Hola, {{ $user->name }},</p>
        <p>Gracias por tu compra en Ecotech. Aquí tienes el resumen de tu pedido:</p>

        <h2>Productos:</h2>
        <ul>
            @foreach($products as $product)
                <li>{{ $product->name }} - {{ $product->price }}€ - Cantidad: {{ $product->pivot->amount }}</li>
            @endforeach
        </ul>

        <p>Para cualquier consulta, no dudes en contactarnos en ecotech@gmail.com.</p>

        <p>¡Esperamos que disfrutes de tus productos!</p>
    </div>
</body>
</html>

