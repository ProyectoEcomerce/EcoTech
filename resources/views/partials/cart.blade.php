@if(auth()->check())
    <div class="cart-sidebar">
        @php
            $cartProducts = optional(auth()->user()->cart)->products ?? collect();
        @endphp
        @forelse($cartProducts as $product)
            <div class="cart-item">
                <p>{{ $product->name }}</p>
                <p>{{ $product->price }}€</p>
                <p>Cantidad:{{$product->pivot->amount}}</p>

                {{-- Sumar cantidad --}}
                <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="amount_change" value="1">
                    <button type="submit" class="btn btn-success">+</button>
                <input>

                <form action="{{ route('cart.updateAmount') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="amount_change" value="1">
                    <button onclick="changeAmount()" class="btn btn-success">+</button>
                </form>
        
                {{-- Quitar cantidad --}}
                <form action="{{ route('cart.updateAmount') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="amount_change" value="-1">
                    <button type="submit" class="btn btn-danger">-</button>
                </form>

                {{-- Quitar producto --}}
                <form action="{{ route('cart.removeitem') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>   
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

