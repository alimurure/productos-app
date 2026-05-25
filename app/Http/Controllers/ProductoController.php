<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductoController extends Controller
{
    // Muestra la lista de todos los productos en formato tabla
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

    // Muestra el detalle de un producto específico
    public function show($id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    // Muestra la galería de productos con filtros de búsqueda y categoría (Retos 1 y 3)
    public function galeria(Request $request) 
    {
        // 1. Iniciamos la consulta base cargando la relación de categorías
        $query = Producto::with('categoria');

        // 2. [Reto 3] Filtro por Nombre / Barra de búsqueda si el usuario escribe algo
        if ($request->has('buscar') && $request->buscar != '') {
            $query->where('nombre', 'LIKE', '%' . $request->buscar . '%');
        }

        // 3. [Reto 1] Filtro por Categoría si el usuario selecciona una del <select>
        if ($request->has('categoria') && $request->categoria != '') {
            $query->where('id_categoria', $request->categoria);
        }

        // 4. Obtenemos los productos finales filtrados
        $productos = $query->get();

        // 5. Traemos TODAS las categorías de la BD para que se pinten en las opciones del <select>
        $categorias = Categoria::all();

        // 6. Enviamos todo a la vista renovada
        return view('productos.galeria', compact('productos', 'categorias'));
    }
}