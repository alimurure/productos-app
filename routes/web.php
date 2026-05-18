<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
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
 
    // Categorías
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
 
    // Productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
 
});
