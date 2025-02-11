<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
    {{-- Navigation --}}
    <nav class="navbar navbar-expand-lg bg-body-tertiary p-4 shadow">
        <div class="container-fluid">
            <span class="navbar-brand"><strong>LSP</strong></span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('homePage') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jadwalPenerbangan') }}">Penerbangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('userTicket') }}">Tiket Saya</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->nama }}
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="{{ route('logoutUser') }}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item" href="{{ route('logoutUser') }}">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('loginForm') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('registrationForm') }}">Register</a>
                        </li>
                    @endauth

                </ul>

            </div>
        </div>
    </nav>

    <div class="main">

        @yield('content')

    </div>

    @yield('script')
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>