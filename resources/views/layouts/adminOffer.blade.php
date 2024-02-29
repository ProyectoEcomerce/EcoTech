@extends('layouts.plantilla')

@section('title', 'adminCoupon')

@section('content')
    <h1 class="text-center">Ofertas</h1>
    <div class="d-flex justify-content-center">
        <a href="#" data-bs-toggle="modal" data-bs-target="#createOfferModal" class="btn btn-success mb-5"><i class="fas fa-plus"></i> Crear oferta</a>
    </div>

    <div class="table-responsive mx-4 my-2">
        <table class="table table-hover  tabla-productos">
            <thead class="table-dark">
                
            <tr>
                <th >Id</th>
                <th>Tipo</th>
                <th>Aplicado en</th>
                <th>Descuento</th>
                <th>Fecha de caducidad</th>
                <th>Límite de usos</th>
                <th>Usos aplicados</th>
            </tr>
        </thead>
        
        @foreach ($offers as $offer)
            <tr>
                <td>{{ $offer->id }}</td>
                <td>{{ $offer->type }}</td>
                <td>{{ $offer->applied }}</td>
                <td>{{ $offer->discount }}%</td>
                <td>{{ $offer->expiration }}</td>
                <td>{{ $offer->limitUses }}</td>
                <td>{{ $offer->usesCounter }}</td>
            </tr>
        @endforeach
    </table>
    </div>

    <div class="modal fade" id="createOfferModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear oferta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('layouts.createOffer') }}" method="POST">
                        @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                        <select name="type" class="form-control mb-2" required>
                            <option value="products" {{ old('type') === 'products' ? 'selected' : '' }}>Productos</option>
                            <option value="categories" {{ old('type') === 'categories' ? 'selected' : '' }}>Categorías</option>
                        </select>
                        <input type="text" name="applied" value="{{ old('applied') }}" placeholder="Código de descuento"
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