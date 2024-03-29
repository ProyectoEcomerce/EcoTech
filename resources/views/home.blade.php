@extends('layouts.plantilla')

@section('title', 'Perfil')

<div class="offcanvas offcanvas-end" tabindex="-1" id="shoppingCart" aria-labelledby="shoppingCartLabel">
    <div class="offcanvas-header">
        <h5 id="shoppingCartLabel">{{ __('Carrito de compra') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @auth
            @include('partials.cart')
        @else
            <!--Para la traducción, en caso de no ser puras cadenas de texto usar variables (Vease rutas, variables php...)-->
            <p>@lang('messages.login_required', ['login' => route('login')])</p>
        @endauth
    </div>
</div>

<form id="logout-form" action="{{ route('custom.logout') }}" method="POST" style="display: none;">
    @csrf
</form>


@section('content')
    <main>
        <div class="container mt-4 mb-4">
            <h2 class="text-center mb-4">{{ __('Mi cuenta') }}</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Mis pedidos -->
                <div class="col">
                    <a href="{{ route('orders.index') }}" class="card-link text-decoration-none">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-box"></i> {{ __('Mis pedidos') }}</h5>
                                <p class="card-text">{{ __('Gestiona tus pedidos y descarga su factura o ticket') }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Direcciones -->
                <div class="col">
                    <a href="{{ route('addresses.adresses') }}" class="card-link text-decoration-none">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-map-marker-alt"></i> {{ __('Direcciones') }}</h5>
                                <p class="card-text">{{ __('Añadir, editar o eliminar direcciones') }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Métodos de pago -->
                <!-- Métodos de pago -->
                <div class="col">
                    <a href="{{ route('payment.methods') }}" class="card-link text-decoration-none">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-credit-card"></i> {{ __('Métodos de pago') }}</h5>
                                <p class="card-text">{{ __('Añadir o eliminar métodos de pago') }}</p>
                            </div>
                        </div>
                    </a>
                </div>


                <!-- Edición de cuenta -->
                <div class="col">
                    <a href="{{ route('account.edit') }}" class="card-link text-decoration-none">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-lock"></i> {{ __('Editar mi cuenta') }}</h5>
                                <p class="card-text">{{ __('Cambiar la contraseña') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Lista de deseos -->
                <div class="col">
                    <a href="{{ route('show.wishlist') }}" class="card-link text-decoration-none">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-lock"></i> {{ __('Lista de deseos') }}</h5>
                                <p class="card-text">{{ __('Visualice sus productos') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Cerrar sesión -->
                <div class="col">
                    <a href="javascript:void(0);" class="card-link text-decoration-none" onclick="confirmLogout()">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-sign-out-alt"></i> {{ __('Cerrar sesión') }}</h5>
                                <p class="card-text">{{ __('Haz clic aquí para cerrar sesión') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        function confirmLogout() {
            if (confirm("{{ __('¿Estás seguro de que quieres cerrar sesión?') }}")) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
@endsection
