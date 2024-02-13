@extends('layouts.plantilla')

@section('title', 'Factura')

@section('content')
    <div class="container mt-5">
        <div class="invoice-box">
            <div class="row mb-4">
                <div class="col-6">
                    <h2>Proveedor:</h2>
                    <p>Fulanito de tal y cual<br>
                        CIF/NIF: 15420650F<br>
                        Calle Paraíso, nº1<br>
                        CP: 14700 Córdoba<br>
                        España</p>
                </div>
                <div class="col-6 text-end">
                    <h2>Factura</h2>
                    <p>Número de factura: 2017-0001<br>
                        Fecha Factura: 22/06/2017</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-6">
                    <h2>Cliente:</h2>
                    <p>VicVal SI<br>
                        CIF/NIF: B30142516<br>
                        C/Mala, nº1<br>
                        18190 Granada<br>
                        España</p>
                </div>
            </div>

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
                    <tr>
                        <td>Servicio de soporte técnico y reparación de sistemas informáticos</td>
                        <td>2</td>
                        <td>40,00 €</td>
                        <td>21 % (16,80 €)</td>
                    </tr>
                    <!-- Agregar más productos o servicios aquí -->
                </tbody>
            </table>

            <div class="row">
                <div class="col-6">
                    <p>Fecha de vencimiento: 22/06/2017</p>
                </div>
                <div class="col-6 text-end">
                    <p>Total Base Imponible: 80,00 €</p>
                    <p>I.V.A. 21%: 16,80 €</p>
                    <p>Retención 15%: -12,00 €</p>
                    <h3>TOTAL: 84,80 €</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
