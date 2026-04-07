# Catálogo de Películas con Laravel

Aplicación web desarrollada con Laravel que permite gestionar un catálogo personal de películas, con filtrado por género, vista de detalle y formulario para agregar nuevas películas.

---

## Instalación y ejecución

```bash
git clone <url-de-tu-repositorio>
cd catalogo-peliculas
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```
Luego abre http://127.0.0.1:8000 en el navegador.

### Servidor activo en el navegador
![Servidor Laravel Activo](img/Captura%20de%20pantalla%202026-04-07%20143016.png)

---

## Paso 1 — Configuración del entorno

Se instaló Laravel con Composer y se generó el controlador principal con Artisan:

```bash
composer create-project laravel/laravel catalogo-peliculas
php artisan make:controller PeliculaController
php artisan serve
```

### Estructura de carpetas

resources/views/
├── layouts/
│   └── app.blade.php
└── peliculas/
├── index.blade.php
├── show.blade.php
├── create.blade.php
└── tarjeta.blade.php

---

## Paso 2 — Rutas definidas

| Método | URI | Nombre | Controlador |
|--------|-----|--------|-------------|
| GET | / | peliculas.index | PeliculaController@index |
| GET | /peliculas/{id} | peliculas.show | PeliculaController@show |
| GET | /peliculas/crear | peliculas.create | PeliculaController@create |
| POST | /peliculas | peliculas.store | PeliculaController@store |

Las rutas usan `Route::name()` y en las vistas se generan URLs con la función `route()`:
```php
<a href="{{ route('peliculas.show', $id) }}">Ver detalle</a>
```

---

## Paso 3 — Controlador con lógica de datos

### ¿Qué es un controlador?
Un controlador en Laravel es una clase PHP que agrupa la lógica de la aplicación. Recibe las peticiones del usuario, procesa los datos y devuelve una respuesta (generalmente una vista).

### Filtrado con colecciones
```php
$peliculas = collect($this->getPeliculas());
$genero = $request->query('genero');

if ($genero) {
    $peliculas = $peliculas->where('genero', $genero);
}
```
`collect()` convierte el array en una Colección de Laravel, lo que permite usar métodos como `->where()` para filtrar, `->pluck()` para extraer campos y `->unique()` para eliminar duplicados. Es más expresivo y legible que usar `array_filter()`.

---

## Paso 4 — Vistas Blade

### ¿Qué hace @extends?
`@extends('layouts.app')` indica que una vista hereda el layout base. La vista hija solo define el contenido de las secciones con `@section`, y el layout las inserta con `@yield`.

### Diferencia entre @extends y @component
- `@extends` se usa para heredar un layout completo (estructura de página entera).
- `@component` se usa para reutilizar un fragmento pequeño de UI, como una tarjeta o un botón.

Ejemplo de `@extends`:
```blade
@extends('layouts.app')
@section('contenido')
    <h1>Hola</h1>
@endsection
```

Ejemplo de `@include` (componente reutilizable):
```blade
@include('peliculas.tarjeta', ['id' => $id, 'pelicula' => $pelicula])
```

### Diferencia entre @foreach y @forelse
- `@foreach` itera sobre una colección pero no maneja el caso vacío.
- `@forelse` incluye un bloque `@empty` que se muestra si la colección no tiene elementos.

```blade
@forelse($peliculas as $id => $pelicula)
    @include('peliculas.tarjeta', ['id' => $id, 'pelicula' => $pelicula])
@empty
    <p>No hay películas en este género.</p>
@endforelse
```

### Parámetros de ruta
Los parámetros de ruta se definen con `{id}` en `web.php` y se reciben automáticamente como argumento en el método del controlador:
```php
// web.php
Route::get('/peliculas/{id}', [PeliculaController::class, 'show']);

// Controlador
public function show($id) {
    // $id contiene el valor de la URL
}
```