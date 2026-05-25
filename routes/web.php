<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Models\Categoria;
use App\Models\Producto;

// ──────────────────────────────────────────────────────────────────────
// RUTAS PÚBLICAS (no requieren sesión iniciada)
// ──────────────────────────────────────────────────────────────────────

// Página de inicio – muestra estadísticas generales
Route::get('/', function () {
    return view('home', [
        'totalCategorias' => Categoria::count(),
        'totalProductos'  => Producto::count(),
    ]);
})->name('home');

// Login: mostrar formulario
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Login: procesar formulario (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ──────────────────────────────────────────────────────────────────────
// RUTAS PROTEGIDAS (requieren sesión activa – middleware auth)
// ──────────────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Mantenimiento de Categorías
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

    // Mantenimiento de Productos (Vista en Tabla)
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

    // [RETOS 1 y 3] Galería de productos (vista en tarjetas animadas con foto y buscador)
    Route::get('/galeria', [ProductoController::class, 'galeria'])->name('productos.galeria');

    // Detalle de un producto específico
    Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');

    // ──────────────────────────────────────────────────────────────────
    // RUTAS DEL CARRITO DE COMPRAS
    // ──────────────────────────────────────────────────────────────────
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::post('/carrito/quitar/{id}', [CarritoController::class, 'quitar'])->name('carrito.quitar');
    Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

    // [RETO 4] Procesar pago y emitir Ticket de Confirmación Animado
    Route::get('/carrito/confirmacion', [CarritoController::class, 'confirmacion'])->name('carrito.confirmacion');

});