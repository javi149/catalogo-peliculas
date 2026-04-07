@extends('layouts.app')

@section('contenido')
<div class="row">
    <div class="col-md-8">
        <h2>{{ $pelicula['titulo'] }}
            @if($pelicula['calificacion'] >= 9)
                <span class="badge bg-success">⭐ Obra maestra</span>
            @elseif($pelicula['calificacion'] >= 7)
                <span class="badge bg-primary">👍 Recomendada</span>
            @else
                <span class="badge bg-secondary">Regular</span>
            @endif
        </h2>
        <p><strong>Director:</strong> {{ $pelicula['director'] }}</p>
        <p><strong>Género:</strong> {{ ucfirst($pelicula['genero']) }}</p>
        <p><strong>Año:</strong> {{ $pelicula['anio'] }}</p>
        <p><strong>Calificación:</strong> {{ $pelicula['calificacion'] }}/10</p>
        <p><strong>Sinopsis:</strong> {{ $pelicula['sinopsis'] }}</p>
        <a href="{{ route('peliculas.index') }}" class="btn btn-secondary mt-3">← Volver</a>
    </div>
</div>
@endsection