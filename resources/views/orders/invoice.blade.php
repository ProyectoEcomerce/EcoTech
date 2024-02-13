<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
    @vite('resources/scss/app.scss', 'resources/js/app.js')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
</head>

<body>
    <main>
        <div class="container mt-5">
            <div class="invoice-box">
                <div class="row mb-4">
                    <div class="col-4">
                        <h2>Proveedor:</h2>
                        <p>Ecotech S.L<br>
                            CIF/NIF: 15420650F<br>
                            Calle del pato, nº13<br>
                            CP: 41020 Sevilla<br>
                            España</p>
                    </div>
                    <div class="col-4">
                        <img src="/img/logo.png" alt="Logo" class="logo-invoice">
                    </div>
                    <div class="col-4 text-end">
                        <h2>Factura</h2>
                        <p>Número de factura: {{ $order->id }}<br>
                            Fecha Factura: {{ $order->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-6">
                        <h2>Cliente:</h2>
                        @if ($order->user->addresses->isNotEmpty())
                            @php $address = $order->user->addresses->first(); @endphp
                            <p>{{ $order->user->name }}<br>
                                {{ $address->address }}, {{ $address->city }}<br>
                                {{ $address->zip_code }}<br>
                                {{ $address->country }}</p>
                        @else
                            <p>Información de dirección no disponible.</p>
                        @endif
                    </div>
                </div>
                @php
                    $totalBaseImponible = 0;
                    $iva = 0.21;
                    $retencion = 0.15;

                    foreach ($order->products as $product) {
                        $totalBaseImponible += $product->price;
                    }

                    $totalIVA = $totalBaseImponible * $iva;
                    $totalRetencion = $totalBaseImponible * $retencion;
                    $total = $totalBaseImponible + $totalIVA - $totalRetencion;
                @endphp


                <table class="table">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Cantidad</th>
                            <th>Base Imponible</th>
                            <th>I.V.A.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->products as $product)
                            @php
                                $subtotal = $product->price * $product->pivot->amount;
                                $ivaAmount = $subtotal * $iva;
                            @endphp
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->pivot->amount }}</td>
                                <td>{{ number_format($subtotal, 2, ',', '.') }} €</td>
                                <td>{{ number_format($ivaAmount, 2, ',', '.') }} € (21%)</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>

                <div class="row">
                    <div class="col-6">
                        <p>Fecha de vencimiento: 22/06/2017</p>
                    </div>
                    <div class="col-6 text-end">
                        <p>Total Base Imponible: {{ number_format($totalBaseImponible, 2, ',', '.') }} €</p>
                        <p>I.V.A. 21%: {{ number_format($totalIVA, 2, ',', '.') }} €</p>
                        <p>Retención 15%: -{{ number_format($totalRetencion, 2, ',', '.') }} €</p>
                        <h3>TOTAL: {{ number_format($total, 2, ',', '.') }} €</h3>
                    </div>
                </div>
            </div>
            <button id="printButton">Imprimir</button>
            <a href="{{ route('orders.view', $order->id) }}" id="backButton" class="btn btn-secondary"> Volver</a>
        </div>
    </main>
</body>

<script>
    document.getElementById('printButton').addEventListener('click', function() {
        window.print();
    });
</script>

</html>
