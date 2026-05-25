<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CarritoController extends Controller
{
    // Método privado universal: Obtiene el carrito de forma segura usando la petición global
    private function obtenerCarrito()
    {
        $carritoCookie = request()->cookie('carrito_universal');
        if ($carritoCookie) {
            // Intentar decodificar; si está encriptado por Laravel se recupera automáticamente
            $datos = json_decode($carritoCookie, true);
            return is_array($datos) ? $datos : [];
        }
        return [];
    }

    // 1. MOSTRAR EL CARRITO
    public function index()
    {
        $carrito = $this->obtenerCarrito();
        $productos = [];
        $total = 0;

        foreach ($carrito as $id => $cantidad) {
            $producto = Producto::find($id);
            if ($producto) {
                $subtotal = $producto->precio * $cantidad;
                $total += $subtotal;
                $productos[] = [
                    'producto' => $producto,
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotal
                ];
            }
        }

        return view('carrito.index', compact('productos', 'total'));
    }

    // 2. AGREGAR PRODUCTO O INCREMENTAR CANTIDAD
    public function agregar($id)
    {
        $producto = Producto::find($id);
        if (!$producto) return redirect()->back();

        $carrito = $this->obtenerCarrito();

        if (isset($carrito[$id])) {
            // No permite agregar más del stock real en base de datos
            if ($carrito[$id] < $producto->stock) {
                $carrito[$id]++;
            }
        } else {
            $carrito[$id] = 1;
        }

        // 🛡️ El truco definitivo: Enviamos la cookie pegada en el redirect para que no se pierda
        return redirect()->route('carrito.index')
            ->withCookie(cookie('carrito_universal', json_encode($carrito), 525600));
    }

    // 3. DISMINUIR CANTIDAD O ELIMINAR
    public function quitar($id)
    {
        $carrito = $this->obtenerCarrito();

        if (isset($carrito[$id])) {
            if ($carrito[$id] > 1) {
                $carrito[$id]--;
            } else {
                unset($carrito[$id]);
            }
        }

        // Enviamos la cookie actualizada en la redirección
        return redirect()->route('carrito.index')
            ->withCookie(cookie('carrito_universal', json_encode($carrito), 525600));
    }

    // 4. VACIAR TODO EL CARRITO
    public function vaciar()
    {
        // Forzar la expiración de la cookie pegándola a la respuesta
        return redirect()->route('carrito.index')
            ->withCookie(cookie()->forget('carrito_universal'));
    }

    // 5. PROCESAR COMPRA Y EMITIR TICKET (RETO 4)
    public function confirmacion()
    {
        $carrito = $this->obtenerCarrito();
        if (empty($carrito)) return redirect()->route('productos.galeria');

        $total = 0;
        foreach ($carrito as $id => $cantidad) {
            $producto = Producto::find($id);
            if ($producto) {
                $total += $producto->precio * $cantidad;
                $producto->stock -= $cantidad;
                $producto->save();
            }
        }

        // Al finalizar la compra con éxito, destruimos la cookie del carrito
        return response()->view('carrito.confirmacion', [
            'total' => $total,
            'codigo' => rand(100000, 999999)
        ])->withCookie(cookie()->forget('carrito_universal'));
    }
}