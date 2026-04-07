<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    private function getPeliculas()
    {
        return [
            1 => ['titulo' => 'Inception', 'director' => 'Christopher Nolan', 'genero' => 'ciencia-ficcion', 'anio' => 2010, 'sinopsis' => 'Un ladrón que roba secretos a través de los sueños.', 'calificacion' => 9],
            2 => ['titulo' => 'El Padrino', 'director' => 'Francis Ford Coppola', 'genero' => 'drama', 'anio' => 1972, 'sinopsis' => 'La historia de la familia mafiosa Corleone.', 'calificacion' => 10],
            3 => ['titulo' => 'The Dark Knight', 'director' => 'Christopher Nolan', 'genero' => 'accion', 'anio' => 2008, 'sinopsis' => 'Batman enfrenta al Joker en Gotham City.', 'calificacion' => 9],
            4 => ['titulo' => 'Pulp Fiction', 'director' => 'Quentin Tarantino', 'genero' => 'crimen', 'anio' => 1994, 'sinopsis' => 'Historias entrelazadas del bajo mundo de Los Ángeles.', 'calificacion' => 9],
            5 => ['titulo' => 'Interstellar', 'director' => 'Christopher Nolan', 'genero' => 'ciencia-ficcion', 'anio' => 2014, 'sinopsis' => 'Exploradores viajan a través de un agujero de gusano.', 'calificacion' => 8],
            6 => ['titulo' => 'El Rey León', 'director' => 'Roger Allers', 'genero' => 'animacion', 'anio' => 1994, 'sinopsis' => 'Un joven león debe reclamar su reino.', 'calificacion' => 8],
            7 => ['titulo' => 'Matrix', 'director' => 'Wachowski', 'genero' => 'ciencia-ficcion', 'anio' => 1999, 'sinopsis' => 'Un hacker descubre la verdad sobre su realidad.', 'calificacion' => 9],
            8 => ['titulo' => 'Forrest Gump', 'director' => 'Robert Zemeckis', 'genero' => 'drama', 'anio' => 1994, 'sinopsis' => 'La vida extraordinaria de un hombre simple de Alabama.', 'calificacion' => 8],
        ];
    }

    public function index(Request $request)
    {
        $peliculas = collect($this->getPeliculas());
        $genero = $request->query('genero');

        if ($genero) {
            $peliculas = $peliculas->where('genero', $genero);
        }

        $generos = collect($this->getPeliculas())->pluck('genero')->unique()->values();

        return view('peliculas.index', compact('peliculas', 'genero', 'generos'));
    }

    public function show($id)
    {
        $peliculas = $this->getPeliculas();

        if (!isset($peliculas[$id])) {
            return redirect()->route('peliculas.index')->with('error', 'Película no encontrada.');
        }

        $pelicula = $peliculas[$id];
        return view('peliculas.show', compact('pelicula', 'id'));
    }

    public function create()
    {
        return view('peliculas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'       => 'required|string|max:255',
            'director'     => 'required|string|max:255',
            'genero'       => 'required|string',
            'anio'         => 'required|integer|min:1900|max:2025',
            'sinopsis'     => 'required|string',
            'calificacion' => 'required|integer|min:1|max:10',
        ]);

        return redirect()->route('peliculas.index')->with('success', 'Película agregada correctamente.');
    }
}