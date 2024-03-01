@extends('layouts.plantilla')

@section('title', 'adminOffer')

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
                <td>Acciones</td>
            </tr>
        </thead>
        
        @foreach ($offers as $offer)
        @php
            if ($offer->type === 'products') {
                $applied = $offer->product->pluck('pivot.product_id')->implode(', ');
            } elseif ($offer->type === 'categories') {
                $applied = $offer->category->pluck('pivot.category_id')->implode(', '); 
            }
        @endphp
            <tr>
                <td>{{ $offer->id }}</td>
                <td>{{ $offer->type }}</td>
                <td>{{ $applied }}</td>
                <td>{{ $offer->discount }}%</td>
                <td>{{ $offer->expiration }}</td>
                <td>{{ $offer->limitUses }}</td>
                <td>{{ $offer->usesCounter }}</td>
                <td><a href="#editOfferModal{{ $offer->id }}" data-bs-toggle="modal"
                    data-bs-target="#editOfferModal{{ $offer->id }}" class="btn btn-warning btn-sm d-inline-block" id="btn-tabla-productos"><i class="fas fa-edit"></i> 
                </a></td>
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
                        <div class="form-group mb-2" id="appliedProducts">
                            <input type="text" name="applied" value="{{ old('applied') }}" placeholder="Aplicación de descuento" class="form-control">
                        </div>
                    
                        <div class="form-group mb-2" id="appliedCategories">
                            @foreach ($categories as $category)
                            <label for="applied">{{$category->name}}</label>
                            <input class="form-check-input" type="checkbox" name="applied" id="applied" value="{{$category->id}}">
                            @endforeach
                        </div>
                        <input type="number" name="discount" value="{{ old('discount') }}" placeholder="Descuento"
                            class="form-control mb-2" autofocus>
                        <input type="date" name="expiration" value="{{ old('expiration') }}"
                            placeholder="Fecha de expiración" class="form-control mb-2">
                        <input type="number" name="limitUses" value="{{ old('limitUses') }}" placeholder="Límite de usos"
                            class="form-control mb-2">

                        <button class="btn btn-secondary btn-block" type="submit" onclick="return confirm('¿Quieres crear este nuevo producto?')">
                            Crear nueva oferta
                        </button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($offers as $offer)
        <div class="modal fade" id="editOfferModal{{ $offer->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Editando la oferta: {{ $offer->id  }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('layouts.updateOffer', $offer->id) }}" method="POST">
                            @method('PUT') {{-- Necesitamos cambiar al método PUT para editar --}}
                            @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                        <select name="type2" class="form-control mb-2" required>
                            <option value="products" {{ $offer->type === 'products' ? 'selected' : '' }}>Productos</option>
                            <option value="categories" {{ $offer->type === 'categories' ? 'selected' : '' }}>Categorías</option>
                        </select>
                        @php
                        if ($offer->type === 'products') {
                            $applied = $offer->product->pluck('pivot.product_id')->implode(', ');
                        } elseif ($offer->type === 'categories') {
                            $applied = $offer->category->pluck('pivot.category_id')->implode(', '); 
                        }
                        @endphp
                        <div class="form-group mb-2" id="appliedProducts{{$offer->id}}">
                            <input type="text" name="applied" value="{{ $applied }}" placeholder="Aplicación de descuento" class="form-control">
                        </div>
                    
                        <div class="form-group mb-2" id="appliedCategories{{$offer->id}}">
                            @foreach ($categories as $category)
                            <label for="applied">{{$category->name}}</label>
                            <input class="form-check-input" type="checkbox" name="applied" id="applied" value="{{$category->id}}" {{$category->offer->contains($category->id) ? 'checked': ''}}>
                            @endforeach
                        </div>
                        <input type="number" name="discount" value="{{ $offer->discount }}" placeholder="Descuento"
                            class="form-control mb-2" autofocus>
                        <input type="date" name="expiration" value="{{ $offer->expiration }}"
                            placeholder="Fecha de expiración" class="form-control mb-2">
                        <input type="number" name="limitUses" value="{{ $offer->limitUses }}" placeholder="Límite de usos"
                            class="form-control mb-2">

                            <button class="btn btn-secondary btn-block" type="submit" onclick="return confirm('¿Quieres guardar los cambios de la oferta: '+ '{{$offer->id}}' +'?')">
                                Guardar cambios
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function(){
        // Oculta inicialmente los campos de productos y categorías
        $('#appliedCategories').hide();

        // Muestra u oculta los campos según el tipo seleccionado
        $('select[name="type"]').change(function(){
            let selectedType = $(this).val();

            if(selectedType === 'products') {
                $('#appliedProducts').show();
                $('#appliedCategories').hide();
            } else if(selectedType === 'categories') {
                $('#appliedProducts').hide();
                $('#appliedCategories').show();
            }
        });
    });

    $(document).ready(function(){
    @foreach($offers as $offer)
        @if($offer->type == "products")
            $('#appliedCategories{{$offer->id}}').hide();
        @elseif ($offer->type == "categories")
            $('#appliedProducts{{$offer->id}}').hide();
        @endif
        // Oculta inicialmente los campos de productos y categorías


        // Muestra u oculta los campos según el tipo seleccionado
        $('select[name="type2"]').change(function(){
            let selectedType = $(this).val();

            if(selectedType === 'products') {
                $('#appliedProducts{{$offer->id}}').show();
                $('#appliedCategories{{$offer->id}}').hide();
            } else if(selectedType === 'categories') {
                $('#appliedProducts{{$offer->id}}').hide();
                $('#appliedCategories{{$offer->id}}').show();
            }
        });
    @endforeach
});
</script>