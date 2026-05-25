<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Asegura la importación de Auth para el Reto 4
use App\Http\Controllers\Controller;

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
        
        // Control de seguridad extra por si intentan agregar un producto con stock 0
        if ($producto->stock <= 0) {
            return back()->with('error', '¡Lo sentimos! ' . $producto->nombre . ' está agotado.');
        }

        $carrito  = session('carrito', []);

        if (isset($carrito[$id])) {
            // Si ya existe, incrementa la cantidad
            if ($carrito[$id] < $producto->stock) {
                $carrito[$id]++;
            } else {
                return back()->with('error', 'No hay más stock disponible de ' . $producto->nombre);
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

    // Vacía completamente el carrito
    public function vaciar()
    {
        session()->forget('carrito');
        return back()->with('info', 'El carrito ha sido vaciado.');
    }

    // =========================================================================
    // [RETO 4] MUESTRA LA VISTA DE CONFIRMACIÓN DE PEDIDO ANIMADA
    // =========================================================================
    public function confirmacion()
    {
        $carrito = session('carrito', []);
        
        // Si intentan entrar a confirmación con el carrito vacío, los mandamos a la galería
        if (empty($carrito)) {
            return redirect()->route('productos.galeria')->with('info', 'Tu carrito está vacío.');
        }
        
        $total = 0;

        // Calculamos el total recorriendo los productos reales de la BD
        foreach ($carrito as $id => $cantidad) {
            $producto = Producto::find($id);
            if ($producto) {
                $total += $producto->precio * $cantidad;
                
                // Opcional y ultra profesional: Descontamos el stock en la BD por cada compra
                if ($producto->stock >= $cantidad) {
                    $producto->stock -= $cantidad;
                    $producto->save();
                }
            }
        }

        // Vaciamos el carrito de la sesión ya que el pedido ha sido procesado con éxito
        session()->forget('carrito');

        // Retornamos la vista pasándole el total calculado
        return view('carrito.confirmacion', compact('total'));
    }
}