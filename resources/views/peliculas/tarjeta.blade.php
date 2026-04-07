<div class="col-md-3 mb-4">
    <div class="card h-100 shadow-sm">
        <img src="https://placehold.co/300x180?text={{ urlencode($pelicula['titulo']) }}"
             class="card-img-top" alt="{{ $pelicula['titulo'] }}">
        <div class="card-body">
            <h5 class="card-title">{{ $pelicula['titulo'] }}</h5>
            <p class="card-text text-muted">{{ $pelicula['director'] }}</p>
            <a href="{{ route('peliculas.show', $id) }}" class="btn btn-primary btn-sm">Ver detalle</a>
        </div>
    </div>
</div>