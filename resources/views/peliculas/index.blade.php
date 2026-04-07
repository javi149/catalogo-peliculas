@extends('layouts.app')

@section('contenido')
<h2 class="mb-4">{{ $genero ? 'Género: '.ucfirst($genero) : 'Todas las películas' }}</h2>

<div class="row">
    @forelse($peliculas as $id => $pelicula)
        @include('peliculas.tarjeta', ['id' => $id, 'pelicula' => $pelicula])
    @empty
        <p class="text-muted">No hay películas en este género.</p>
    @endforelse
</div>
@endsection