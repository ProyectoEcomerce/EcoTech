<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/app.css', 'resources/css/app.scss', 'resources/js/carrito.js')
    <title>Header</title>
</head>

<body>
    <nav>
        <div class="d-flex justify-content-center align-items-center">
            @if (Route::has('login'))
                <div class="position-fixed top-0 end-0 p-3 text-end">
                    <a href="#" class="text-secondary" id="cart-icon">
                        <i class="bi bi-cart"></i>
                    </a>
                    @auth
                        <a href="{{ url('/home') }}" class="fw-bold text-secondary text-decoration-none">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="fw-bold text-secondary text-decoration-none">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ms-2 fw-bold text-secondary text-decoration-none">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>
    <div class="bg-light">
        <div class="container">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Categoría 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Categoría 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Categoría 3</a>
                </li>
                <!-- Más categorías -->
            </ul>
        </div>
    </div>

    <section>
        <div id="cart-sidebar">dsd</div>
    </section>
</body>

</html>
