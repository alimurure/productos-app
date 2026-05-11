<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Categoria;
 
class CategoriaController extends Controller
{
    /**
     * Muestra la lista de todas las categorías.
     */
    public function index()
    {
        // Obtiene todas las categorías e incluye sus productos
        $categorias = Categoria::with('productos')->get();
 
        // Retorna la vista y le pasa la variable $categorias
        return view('categorias.index', compact('categorias'));
    }
}
