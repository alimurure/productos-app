<?php
 
namespace App\Http\Controllers;
 
use App\Models\Producto;
use Illuminate\Http\Request;
 
class CarritoController extends Controller
{
    // Muestra el contenido del carrito
    public function index()
    {
        $carrito   = session('carrito', []);
        $productos = [];
        $total     = 0;
 
        foreach ($carrito as $id => $cantidad) {
            $producto = Producto::find($id);
            if ($producto) {
                $subtotal    = $producto->precio * $cantidad;
                $total      += $subtotal;
                $productos[] = [
                    'producto' => $producto,
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotal,
                ];
            }
        }
 
        return view('carrito.index', compact('productos', 'total'));
    }
 
    // Agrega un producto al carrito (o incrementa su cantidad)
    public function agregar($id)
    {
        $producto = Producto::findOrFail($id);
        $carrito  = session('carrito', []);
 
        if (isset($carrito[$id])) {
            // Si ya existe, incrementa la cantidad
            if ($carrito[$id] < $producto->stock) {
                $carrito[$id]++;
            } else {
                return back()->with('error', 'No hay mas stock disponible de ' . $producto->nombre);
            }
        } else {
            // Primera vez: agrega con cantidad 1
            $carrito[$id] = 1;
        }
 
        session(['carrito' => $carrito]);
        return back()->with('success', $producto->nombre . ' agregado al carrito.');
    }
 
    // Quita una unidad de un producto (o lo elimina si queda en 0)
    public function quitar($id)
    {
        $carrito = session('carrito', []);
 
        if (isset($carrito[$id])) {
            if ($carrito[$id] > 1) {
                $carrito[$id]--;
            } else {
                unset($carrito[$id]);
            }
        }
 
        session(['carrito' => $carrito]);
        return back()->with('info', 'Producto actualizado en el carrito.');
    }
 
    // Vacia completamente el carrito
    public function vaciar()
    {
        session()->forget('carrito');
        return back()->with('info', 'El carrito ha sido vaciado.');
    }
}
