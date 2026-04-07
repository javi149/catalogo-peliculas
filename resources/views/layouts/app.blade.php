<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Películas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('peliculas.index') }}">🎬 Catálogo</a>
        <div class="navbar-nav">
            <a class="nav-link" href="{{ route('peliculas.index') }}">Todas</a>
            @foreach(['accion','drama','ciencia-ficcion','crimen','animacion'] as $g)
                <a class="nav-link" href="{{ route('peliculas.index', ['genero' => $g]) }}">{{ ucfirst($g) }}</a>
            @endforeach
            <a class="nav-link btn btn-outline-light ms-2" href="{{ route('peliculas.create') }}">+ Agregar</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('contenido')
</div>

<footer class="text-center text-muted mt-5 mb-3">
    <small>Catálogo de Películas &copy; {{ date('Y') }}</small>
</footer>
</body>
</html>