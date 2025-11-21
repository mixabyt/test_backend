<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'news' }}</title>
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
</head>
<body class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('news') }}">
            Новини
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        Мої новини
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="btn btn-outline-primary" href="{{ route('login') }}">
                            Увійти
                        </a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item d-flex align-items-center me-3">
                        <span class="text-muted">
                            Привіт, <strong>{{ Auth::user()->name }}</strong>
                        </span>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-danger">
                                Вийти
                            </button>
                        </form>
                    </li>
                @endauth

            </ul>

        </div>
    </div>
</nav>
<main class="flex-fill">
    {{$slot}}
</main>

<footer class="bg-dark text-white text-center py-2">
    &copy; 2025
</footer>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
