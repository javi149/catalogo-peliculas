@extends('layouts.app')

@section('contenido')
<h2>Agregar Película</h2>
<form method="POST" action="{{ route('peliculas.store') }}">
    @csrf
    <div class="mb-3">
        <label>Título</label>
        <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo') }}">
        @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label>Director</label>
        <input type="text" name="director" class="form-control @error('director') is-invalid @enderror" value="{{ old('director') }}">
        @error('director') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label>Género</label>
        <input type="text" name="genero" class="form-control @error('genero') is-invalid @enderror" value="{{ old('genero') }}">
        @error('genero') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label>Año</label>
        <input type="number" name="anio" class="form-control @error('anio') is-invalid @enderror" value="{{ old('anio') }}">
        @error('anio') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label>Sinopsis</label>
        <textarea name="sinopsis" class="form-control @error('sinopsis') is-invalid @enderror">{{ old('sinopsis') }}</textarea>
        @error('sinopsis') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label>Calificación (1-10)</label>
        <input type="number" name="calificacion" min="1" max="10" class="form-control @error('calificacion') is-invalid @enderror" value="{{ old('calificacion') }}">
        @error('calificacion') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('peliculas.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection