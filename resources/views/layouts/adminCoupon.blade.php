@extends('layouts.plantilla')

@section('title', 'adminCoupon')

@section('content')
    <h1 class="text-center">Cupones</h1>
    <div class="d-flex justify-content-center">
        <a href="#" data-bs-toggle="modal" data-bs-target="#createCouponModal" class="btn btn-success mb-5"><i class="fas fa-plus"></i> Crear cupón</a>
    </div>

    <div class="table-responsive mx-4 my-2">
        <table class="table table-hover  tabla-productos">
            <thead class="table-dark">
                
            <tr>
                <th >Id</th>
                <th>Código</th>
                <th>Descuento</th>
                <th>Fecha de caducidad</th>
                <th>Límite de usos</th>
                <th>Usos aplicados</th>
            </tr>
        </thead>
        
        @foreach ($coupons as $coupon)
            <tr>
                <td>{{ $coupon->id }}</td>
                <td>{{ $coupon->code }}</td>
                <td>{{ $coupon->discount }}%</td>
                <td>{{ $coupon->expiration }}</td>
                <td>{{ $coupon->limitUses }}</td>
                <td>{{ $coupon->usesCounter }}</td>
            </tr>
        @endforeach
    </table>
    </div>

    <div class="modal fade" id="createCouponModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear cupón</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('layouts.createCoupon') }}" method="POST">
                        @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                        <input type="text" name="code" value="{{ old('code') }}" placeholder="Código de descuento"
                            class="form-control mb-2">
                        <input type="number" name="discount" value="{{ old('discount') }}" placeholder="Descuento"
                            class="form-control mb-2" autofocus>
                        <input type="date" name="expiration" value="{{ old('expiration') }}"
                            placeholder="Fecha de expiración" class="form-control mb-2">
                        <input type="number" name="limitUses" value="{{ old('limitUses') }}" placeholder="Límite de usos"
                            class="form-control mb-2">

                        <button class="btn btn-secondary btn-block" type="submit" onclick="return confirm('¿Quieres crear este nuevo producto?')">
                            Crear nuevo cupón
                        </button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection