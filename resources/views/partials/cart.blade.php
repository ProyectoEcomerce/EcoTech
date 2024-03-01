@if (auth()->check())
<div class="cart-sidebar">
    @php
        $cartProducts = optional(auth()->user()->cart)->products ?? collect();
    @endphp

    @forelse($cartProducts as $product)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{{ $product->price }}€</p>
            <p class="card-text">{{ __('Cantidad:') }} {{ $product->pivot->amount }}</p>

            {{-- Botón para sumar cantidad --}}
            <form action="{{ route('cart.updateAmount') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="amount_change" value="1">
                <button type="submit" class="btn btn-outline-success btn-sm">+</button>
            </form>

            {{-- Botón para quitar cantidad --}}
            <form action="{{ route('cart.updateAmount') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="amount_change" value="-1">
                <button type="submit" class="btn btn-outline-danger btn-sm">-</button>
            </form>

            {{-- Botón para quitar producto --}}
            <form action="{{ route('cart.removeitem') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('Eliminar') }}</button>
            </form>
        </div>
    </div>
    @empty
    <p>{{ __('Tu carrito está vacío') }}</p>
    @endforelse

    {{-- Botón para tramitar pedido, visible solo si hay productos --}}
    @if($cartProducts->isNotEmpty())
    <form action="{{ route('orders.buy') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success w-100">{{ __('Tramitar pedido') }}</button>
    </form>
    @endif
</div>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@endif
