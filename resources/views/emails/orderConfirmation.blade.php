<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }
        h1 {
            color: #007bff;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirmación de Pedido</h1>
        <p>Hola, {{ $user->name }},</p>
        <p>Gracias por tu compra en [Nombre de la Tienda]. Aquí tienes el resumen de tu pedido:</p>

        <h2>Productos:</h2>
        <ul>
            @foreach($products as $product)
                <li>{{ $product->name }} - {{ $product->price }}€ - Cantidad: {{ $product->quantity }}</li>
            @endforeach
        </ul>

        <h2>Dirección de entrega:</h2>
        <p>{{ $deliveryAddress->address }}, {{ $deliveryAddress->city }}, {{ $deliveryAddress->zipCode }}, {{ $deliveryAddress->country }}</p>

        <h2>Precio total:</h2>
        <p>{{ $totalPrice }}€</p>

        <p>Para cualquier consulta, no dudes en contactarnos en [ecotech@gmail.com].</p>

        <p>¡Esperamos que disfrutes de tus productos!</p>
    </div>
</body>
</html>

