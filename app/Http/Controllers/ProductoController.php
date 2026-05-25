<?php
 
namespace App\Http\Controllers;
 
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
 
class ProductoController extends Controller
{
    // Muestra la lista de todos los productos
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }
 
    // Muestra el detalle de un producto especifico
    public function show($id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);
        return view('productos.show', compact('producto'));
    }
}
