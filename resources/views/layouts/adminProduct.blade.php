@extends('layouts.plantilla')

@section('title', 'adminProduct')
@section('content')
    <h1 class="text-center">Productos</h1>
    <div class="d-flex justify-content-center">
        <a href="#" data-bs-toggle="modal" data-bs-target="#createProductModal" class="btn btn-success mb-5"><i class="fas fa-plus"></i> Añadir
            producto</a>
    </div>
    
    
    <div class="table-responsive mx-4 my-2">
        <table class="table table-hover  tabla-productos">
            <thead class="table-dark">
                
            <tr>
                <th>Nombre</th>
                <th class="d-none d-xxl-table-cell">Id</th>
                <th class="d-none d-xxl-table-cell">Precio</th>
                <th class="d-none d-xxl-table-cell">Precio oferta</th>
                <th class="d-none d-xxl-table-cell">Voltaje</th>
                <th class="d-none d-xxl-table-cell">Garantía</th>
                
                <th class="d-none d-xxl-table-cell">Peso</th>
                <th class="d-none d-xxl-table-cell">Materiales</th>
                
                <th class="d-none d-xxl-table-cell">Dimensiones</th>
                <th class="d-none d-xxl-table-cell">Categoría/s</th>
                <th>Acciones</th>

            </tr>
        </thead>
        
        @foreach ($products as $product)
        @php
            $guaranteeText= ($product->guarantee > 1 )? __("años") : __("año");
        @endphp
            <tr>
                <td class="d-none d-xxl-table-cell">{{ $product->id }}</td>
                <td class="d-none d-xxl-table-cell">{{ $product->name }}</td>
                <td class="d-none d-xxl-table-cell">{{ $product->price }}€</td>
                <td class="d-none d-xxl-table-cell">{{ $product->offerPrice }}€</td>
                <td class="d-none d-xxl-table-cell">{{ $product->voltage }}V</td>
                <td class="d-none d-xxl-table-cell">{{ $product->guarantee }} {{$guaranteeText}}</td>
                <td class="d-none d-xxl-table-cell">{{ $product->weigth }}kg</td>
                <td class="d-none d-xxl-table-cell">{{ $product->materials }}</td>
                <td class="d-none d-xxl-table-cell">{{ $product->dimensions }}</td>
                <td class="d-none d-xxl-table-cell">
                    @if($product->categories->isEmpty())
                        Ninguna
                    @else
                        {{ $product->categories->pluck('name')->join(', ') }}
                    @endif
                </td>
                <td>
                    <button class="btn btn-secondary btn-sm d-inline-block" id="btn-tabla-productos" type="button" data-bs-toggle="modal" data-bs-target="#viewDetailsModal{{ $product->id }}">
                        <i class="fas fa-eye"></i>
                    </button>
                    
                
               <a href="#editProductModal{{ $product->id }}" data-bs-toggle="modal"
                        data-bs-target="#editProductModal{{ $product->id }}" class="btn btn-warning btn-sm" id="btn-tabla-productos"><i class="fas fa-edit"></i>  </a>
      
                </td>
            </tr>
        @endforeach
    </table>
    </div>

    <!-- Ver datos -->
    @foreach ($products as $product)
    <div class="modal fade" id="viewDetailsModal{{ $product->id }}" tabindex="-1" aria-labelledby="viewDetailsModalLabel{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewDetailsModalLabel{{ $product->id }}">
                        Detalles del producto: {{ $product->name }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                @php
                    $guaranteeText= ($product->guarantee > 1 )? __("años") : __("año");
                @endphp
                <div class="modal-body">
                    <p><strong>Nombre:</strong> {{ $product->name }}</p>
                    <p><strong>Precio:</strong> {{ $product->price }}€</p>
                    <p><strong>Precio Oferta:</strong> {{ $product->offerPrice }}€</p>
                    <p><strong>Voltaje:</strong> {{ $product->voltage }}V</p>
                    <p><strong>Garantía:</strong> {{ $product->guarantee }} {{$guaranteeText}}</p>
                    <p><strong>Precio manufactura:</strong> {{ $product->manufacturing_price }}€</p>
                    <p><strong>Peso:</strong> {{ $product->weigth }}</p>
                    <p><strong>Materiales:</strong> {{ $product->materials }} kg</p>
                    <p><strong>Descripción:</strong> {{ $product->description }}</p>
                    <p><strong>Dimensiones:</strong> {{ $product->dimensions }}</p>
                    <p><strong>Batería:</strong> {{ $product->battery }}</p>
                    <p><strong>Motor:</strong> {{ $product->engine}}</p>
                    <p><strong>Componentes:</strong> {{ $product->components }}</p>
                    <p><strong>Categoría(s):</strong> 
                        @if($product->categories->isEmpty())
                            Ninguna categoría
                        @else
                            @foreach($product->categories as $category)
                                {{ $category->name }}@if(!$loop->last), @endif
                            @endforeach
                        @endif
                    </p>
                    <p><strong>Estado de visibilidad</strong>
                        @if($product->show)
                            El produto es visible
                        @else
                            El producto no es visible
                        @endif
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

    <div class="modal fade" id="createProductModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Añadir producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('layouts.createProduct') }}" method="POST" enctype="multipart/form-data">
                        @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nombre del producto"
                            class="form-control mb-2">
                        <input type="number" name="price" value="{{ old('price') }}" placeholder="Precio"
                            class="form-control mb-2" autofocus step="0.01">
                        <input type="number" name="offerPrice" value="{{ old('offerPrice') }}"
                            placeholder="Precio especial" class="form-control mb-2" step="0.01">
                        <input type="number" name="voltage" value="{{ old('voltage') }}" placeholder="Voltage"
                            class="form-control mb-2">
                        <input type="number" name="guarantee" value="{{ old('guarantee') }}" placeholder="Garantía"
                            class="form-control mb-2">
                        <input type="number" name="manufacturing_price" value="{{ old('manufacturing_price') }}"
                            placeholder="Precio de manufactura" class="form-control mb-2" step="0.01">
                        <input type="number" name="weigth" value="{{ old('weigth') }}" placeholder="Peso"
                            class="form-control mb-2" step="0.01">
                        <input type="text" name="materials" value="{{ old('materials') }}" placeholder="Materiales"
                            class="form-control mb-2">
                        <input type="text" name="description" value="{{ old('description') }}" placeholder="Descripción"
                            class="form-control mb-2">
                        <input type="text" name="dimensions" value="{{ old('dimensions') }}" placeholder="Dimensiones"
                            class="form-control mb-2">
                        <input type="text" name="battery" value="{{ old('battery') }}" placeholder="Batería"
                            class="form-control mb-2">
                        <input type="text" name="engine" value="{{ old('engine') }}" placeholder="Motor"
                            class="form-control mb-2">
                        <input type="text" name="components" value="{{ old('components') }}" placeholder="Componentes"
                            class="form-control mb-2">
                        <input type="file" name="image[]" accept="image/" class="form-control mb-2" multiple>

                        <div class="mb-2">
                            <p>Categorías:</p>
                            <div class="form-check">
                                <!-- Checkbox para 'Ninguna categoría' -->
                                <input class="form-check-input" type="checkbox" name="no_category" value="none" id="noCategory" onclick="handleNoCategory()">
                                <label class="form-check-label" for="noCategory">
                                    Ninguna categoría
                                </label>
                            </div>
                            @foreach ($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input category-checkbox" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category{{ $category->id }}">
                                    <label class="form-check-label" for="category{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Visibilidad del producto</label>
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="show" {{$product->show ? 'checked': ''}}>
                        </div>

                        <button class="btn btn-secondary btn-block" type="submit">
                            Crear nuevo producto
                        </button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($products as $product)
        <div class="modal fade" id="editProductModal{{ $product->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Editando el producto: {{ $product->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('layouts.updateProduct', $product->id) }}" method="POST">
                            @method('PUT') {{-- Necesitamos cambiar al método PUT para editar --}}
                            @csrf
                            {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                            <input type="text" name="name" class="form-control mb-2" value="{{ $product->name }}"
                                placeholder="Nombre" autofocus>
                            <input type="number" name="price" class="form-control mb-2"
                                value="{{ $product->price }}" placeholder="Precio" autofocus step="0.01">
                            <input type="number" name="offerPrice" placeholder="Precio oferta"
                                class="form-control mb-2" value="{{ $product->offerPrice }}" step="0.01">
                            <input type="number" name="voltage" class="form-control mb-2"
                                value="{{ $product->voltage }}" placeholder="Voltage" autofocus>
                            <input type="number" name="guarantee" class="form-control mb-2"
                                value="{{ $product->guarantee }}" placeholder="Garantía" autofocus>
                            <input type="number" name="manufacturing_price" class="form-control mb-2"
                                value="{{ $product->manufacturing_price }}" placeholder="Manufactura" autofocus step="0.01">
                            <input type="number" name="weigth" class="form-control mb-2"
                                value="{{ $product->weigth }}" placeholder="Peso" autofocus step="0.01">
                            <input type="text" name="materials" class="form-control mb-2"
                                value="{{ $product->materials }}" placeholder="Materiales" autofocus>

                            <input type="text" name="description" class="form-control mb-2"
                                value="{{ $product->description }}" placeholder="Descripción" autofocus>

                            <input type="text" name="dimensions" class="form-control mb-2"
                                value="{{ $product->dimensions }}" placeholder="Dimensiones" autofocus>

                            <input type="text" name="battery" class="form-control mb-2"
                                value="{{ $product->battery }}" placeholder="Batería" autofocus>

                            <input type="text" name="engine" class="form-control mb-2"
                                value="{{ $product->engine }}" placeholder="Motor" autofocus>

                            <input type="text" name="components" class="form-control mb-2"
                                value="{{ $product->components }}" placeholder="Componentes" autofocus>


                                <div class="mb-2">
                                    <p>Categorías:</p>
                                    <div class="form-check">
                                        <!-- Checkbox para 'Ninguna categoría' -->
                                        <input class="form-check-input" type="checkbox" name="no_category" value="none" id="noCategory" onclick="handleNoCategory()">
                                        <label class="form-check-label" for="noCategory">
                                            Ninguna categoría
                                        </label>
                                    </div>
                                    @foreach ($categories as $category)
                                        <div class="form-check">
                                            <input class="form-check-input category-checkbox" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category{{ $category->id }}">
                                            <label class="form-check-label" for="category{{ $category->id }}">
                                                {{ $category->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="show" {{$product->show ? 'checked': ''}}>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Cambiar Visibilidad</label>
                                </div>

                            <button class="btn btn-secondary btn-block" type="submit">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
