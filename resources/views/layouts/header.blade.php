<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/components/header.css') }}">
    <title>Header</title>
</head>

<body>
    <header>
        <div class="d-flex justify-content-center align-items-center vh-100">
            @if (Route::has('login'))
                <div class="position-fixed top-0 end-0 p-3 text-end">
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
    </header>

</body>

</html>
