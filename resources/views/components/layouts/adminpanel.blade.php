<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'news' }}</title>
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
</head>
<body class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('news')}}">Новини</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route("dashboard")}}">Мої новини</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
        </div>


        @guest
            <a href="{{ route('login') }}">Login</a>
        @endguest
        @auth
            <span>Hello, {{Auth::user()->name}}</span>

            <form method="POST" action="{{route('logout')}}">
                @csrf
                <button type="submit"> Log out</button>

            </form>
        @endauth

    </div>
</nav>
<main class="flex-fill">
    {{$slot}}
</main>

<footer class="bg-dark text-white text-center py-2">
    &copy; 2025
</footer>
</body>
</html>
