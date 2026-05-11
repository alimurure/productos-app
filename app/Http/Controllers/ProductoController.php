<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Producto;
 
class ProductoController extends Controller
{
    /**
     * Muestra la lista de todos los productos con su categoría.
     */
    public function index()
    {
        // Obtiene todos los productos e incluye su categoría relacionada
        $productos = Producto::with('categoria')->get();
 
        // Retorna la vista y le pasa la variable $productos
        return view('productos.index', compact('productos'));
    }
}
