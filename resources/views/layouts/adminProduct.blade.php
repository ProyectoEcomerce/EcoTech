@extends('layouts.plantilla')

@section('title', 'adminProduct')
@section('content')
    <h1 class="text-center">Productos</h1>
    <div class="d-flex justify-content-center">
        <a href="#" data-bs-toggle="modal" data-bs-target="#createProductModal" class="btn btn-success mb-5">Añadir
            producto</a>
    </div>
    
    
    <div class="table-responsive mx-4 my-2">
        <table class="table table-hover  tabla-productos">
            <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th class="d-none d-xxl-table-cell">Precio</th>
                <th class="d-none d-xxl-table-cell">Precio oferta</th>
                <th class="d-none d-xxl-table-cell">Voltaje</th>
                <th class="d-none d-xxl-table-cell">Garantía</th>
                <th class="d-none d-xxl-table-cell">Precio manufactura</th>
                <th class="d-none d-xxl-table-cell">Peso</th>
                <th class="d-none d-xxl-table-cell">Materiales</th>
                <th class="d-none d-xxl-table-cell">Descripción</th>
                <th class="d-none d-xxl-table-cell">Dimensiones</th>
                <th class="d-none d-xxl-table-cell">Batería</th>
                <th class="d-none d-xxl-table-cell">Motor</th>
                <th class="d-none d-xxl-table-cell">Componentes</th>
                <th class="d-none d-xxl-table-cell">Categoría/s</th>
                <th>Acciones</th>

            </tr>
        </thead>
        
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td class="d-none d-xxl-table-cell">{{ $product->price }}</td>
                <td class="d-none d-xxl-table-cell">{{ $product->offerPrice }}</td>
                <td class="d-none d-xxl-table-cell">{{ $product->voltage }}</td>
                <td class="d-none d-xxl-table-cell">{{ $product->guarantee }}</td>
                <td class="d-none d-xxl-table-cell">{{ $product->manufacturing_price }}</td>
                <td class="d-none d-xxl-table-cell">{{ $product->weigth }}</td>
                <td class="d-none d-xxl-table-cell">{{ $product->materials }}</td>
                <td class="d-none d-xxl-table-cell">{{ $product->description }}</td>
                <td class="d-none d-xxl-table-cell">{{ $product->dimensions }}</td>
                <td class="d-none d-xxl-table-cell">{{ $product->battery }}</td>
                <td class="d-none d-xxl-table-cell">{{ $product->engine }}</td>
                <td class="d-none d-xxl-table-cell">{{ $product->components }}</td>
                <td class="d-none d-xxl-table-cell">
                    @if($product->categories->isEmpty())
                        Ninguna
                    @else
                        {{ $product->categories->pluck('name')->join(', ') }}
                    @endif
                </td>
                <td>
                    <button class="btn btn-primary btn-sm d-inline-block d-xxl-none" id="btn-tabla-productos" type="button" data-bs-toggle="modal" data-bs-target="#viewDetailsModal{{ $product->id }}">
                        Ver Datos
                    </button>
                    
                
               <a href="#editProductModal{{ $product->id }}" data-bs-toggle="modal"
                        data-bs-target="#editProductModal{{ $product->id }}" class="btn btn-warning btn-sm" id="btn-tabla-productos"> Editar </a>
      
                    <form action="{{ route('layouts.deleteProduct', $product->id) }}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm" type="submit" id="btn-tabla-productos">Eliminar</button>
                    </form>
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
                    <h5 class="modal-title" id="viewDetailsModalLabel{{ $product->id }}">Detalles del Producto</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Nombre:</strong> {{ $product->name }}</p>
                    <p><strong>Precio:</strong> {{ $product->price }}</p>
                    <p><strong>Precio Oferta:</strong> {{ $product->offerPrice }}</p>
                    <p><strong>Voltaje:</strong> {{ $product->voltage }}</p>
                    <p><strong>Garantía:</strong> {{ $product->guarantee }}</p>
                    <p><strong>Precio manufactura:</strong> {{ $product->manufacturing_price }}</p>
                    <p><strong>Peso:</strong> {{ $product->weight }}</p>
                    <p><strong>Materiales:</strong> {{ $product->materials }}</p>
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
                    <h1 class="modal-title">Añadir Producto</h1>
                    <button type="button" class="close" data-dismiss="modal">&times; </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('layouts.createProduct') }}" method="POST" enctype="multipart/form-data">
                        @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nombre del producto"
                            class="form-control mb-2">
                        <input type="text" name="price" value="{{ old('price') }}" placeholder="Precio"
                            class="form-control mb-2" autofocus>
                        <input type="text" name="offerPrice" value="{{ old('offerPrice') }}"
                            placeholder="Precio especial" class="form-control mb-2">
                            
                        <input type="text" name="voltage" value="{{ old('voltage') }}" placeholder="Voltage"
                            class="form-control mb-2">
                        <input type="text" name="guarantee" value="{{ old('guarantee') }}" placeholder="Garantía"
                            class="form-control mb-2">
                        <input type="text" name="manufacturing_price" value="{{ old('manufacturing_price') }}"
                            placeholder="Precio de manufactura" class="form-control mb-2">
                        <input type="text" name="weigth" value="{{ old('weigth') }}" placeholder="Peso"
                            class="form-control mb-2">
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

                        <button class="btn btn-primary btn-block" type="submit">
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
                        <h2>Editando la nota {{ $product->name }}</h2>
                        <button type="button" class="close" data-dismiss="modal">&times; </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('layouts.updateProduct', $product->id) }}" method="POST">
                            @method('PUT') {{-- Necesitamos cambiar al método PUT para editar --}}
                            @csrf
                            {{-- Cláusula para obtener un token de formulario al enviarlo --}}
                            <input type="text" name="name" class="form-control mb-2" value="{{ $product->name }}"
                                placeholder="Nombre" autofocus>
                            <input type="text" name="price" class="form-control mb-2"
                                value="{{ $product->price }}" placeholder="Precio" autofocus>
                            <input type="text" name="offerPrice" placeholder="Precio oferta"
                                class="form-control mb-2" value="{{ $product->offerPrice }}">
                            <input type="text" name="voltage" class="form-control mb-2"
                                value="{{ $product->voltage }}" placeholder="Voltage" autofocus>
                            <input type="text" name="guarantee" class="form-control mb-2"
                                value="{{ $product->guarantee }}" placeholder="Garantía" autofocus>
                            <input type="text" name="manufacturing_price" class="form-control mb-2"
                                value="{{ $product->manufacturing_price }}" placeholder="Manufactura" autofocus>
                            <input type="text" name="weigth" class="form-control mb-2"
                                value="{{ $product->weigth }}" placeholder="Peso" autofocus>
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
                                

                            <button class="btn btn-primary btn-block" type="submit">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
