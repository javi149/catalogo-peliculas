<?php
use App\Http\Controllers\PeliculaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PeliculaController::class, 'index'])->name('peliculas.index');
Route::get('/peliculas/crear', [PeliculaController::class, 'create'])->name('peliculas.create');
Route::get('/peliculas/{id}', [PeliculaController::class, 'show'])->name('peliculas.show');
Route::post('/peliculas', [PeliculaController::class, 'store'])->name('peliculas.store');