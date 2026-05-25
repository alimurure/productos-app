{{-- resources/views/productos/show.blade.php --}}
@extends('layouts.app')
@section('titulo', $producto->nombre)
 
@section('contenido')
<a href="{{ route('productos.galeria') }}" class="btn btn-outline btn-sm"
   style="margin-bottom:1.5rem; display:inline-block">&larr; Volver a la galeria</a>
 
<div class="card" style="display:flex; gap:2rem; flex-wrap:wrap">
 
    {{-- Imagen --}}
    <div style="flex:0 0 320px">
        @if($producto->foto && file_exists(public_path('img/productos/' . $producto->foto)))
            <img src="{{ asset('img/productos/' . $producto->foto) }}"
                 alt="{{ $producto->nombre }}"
                 style="width:100%; border-radius:8px; box-shadow:var(--shadow)">
        @else
            <div class="no-foto" style="height:280px; border-radius:8px;">Sin imagen</div>
        @endif
    </div>
 
    {{-- Informacion --}}
    <div style="flex:1; min-width:260px">
        <h1 style="color:var(--primary-dk); margin-bottom:.4rem">{{ $producto->nombre }}</h1>
        <p style="color:var(--text-light); margin-bottom:1rem">Marca: <strong>{{ $producto->marca }}</strong></p>
 
        <table style="margin-top:0">
            <tr><td style="font-weight:600; width:140px">Precio</td>
                <td>S/. {{ number_format($producto->precio, 2) }}</td></tr>
            <tr><td style="font-weight:600">Stock disponible</td>
                <td>{{ $producto->stock }} unidades</td></tr>
            <tr><td style="font-weight:600">Categoria</td>
                <td>{{ $producto->categoria->descripcion ?? 'Sin categoria' }}</td></tr>
        </table>
 
        <div style="margin-top:1.5rem">
            <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Agregar al carrito</button>
            </form>
        </div>
    </div>
</div>
@endsection
