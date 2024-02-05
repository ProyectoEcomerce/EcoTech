@if (auth()->check())
    <div class="cart-sidebar">
        <h4>Carrito de Compras</h4>
        @forelse(optional(auth()->user()->cart)->products ?? [] as $product)
            <div class="cart-item">
                <p>{{ $product->name }}</p>
                <p>{{ $product->price }}€</p>
            </div>
        @empty
            <p>Tu carrito está vacío.</p>
        @endforelse
        <form action="{{ route('cart.purchase') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Comprar</button>
        </form>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    </div>
@endif
