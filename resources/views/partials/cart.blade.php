@if(auth()->check())
    <div class="cart-sidebar">
        <h4>Carrito de Compras</h4>
        @php
            $cartProducts = optional(auth()->user()->cart)->products ?? collect();
        @endphp
        @forelse($cartProducts as $product)
            <div class="cart-item">
                <p>{{ $product->name }}</p>
                <p>{{ $product->price }}€</p>
            </div>
        @empty
            <p>Tu carrito está vacío.</p>
        @endforelse
        {{-- Asegúrate de que hay productos antes de mostrar el botón de comprar --}}
        @if($cartProducts->isNotEmpty())
            <form action="{{ route('cart.purchase') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Comprar</button>
            </form>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
@endif

