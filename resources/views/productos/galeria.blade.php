{{-- resources/views/productos/galeria.blade.php --}}
@extends('layouts.app')
@section('titulo', 'Galeria de Productos')
 
@section('contenido')
 
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
    <h1 style="color:var(--primary-dk); margin:0">
        Galeria de Productos
        <span style="font-size:1rem; font-weight:normal; color:var(--text-light)">
            ({{ $productos->count() }} productos)
        </span>
    </h1>
    <a href="{{ route('productos.index') }}" class="btn btn-outline btn-sm">Ver como tabla</a>
</div>
 
@if($productos->isEmpty())
    <div class="alert alert-info">No hay productos registrados aun.</div>
@else
    <div class="galeria-grid">
        @foreach($productos as $producto)
        <div class="producto-card">
 
            {{-- Imagen del producto --}}
            @if($producto->foto && file_exists(public_path('img/productos/' . $producto->foto)))
                <img src="{{ asset('img/productos/' . $producto->foto) }}"
                     alt="{{ $producto->nombre }}">
            @else
                <div class="no-foto">Sin imagen</div>
            @endif
 
            <div class="card-body">
                <h3>{{ $producto->nombre }}</h3>
                <p class="marca">{{ $producto->marca }}</p>
 
                {{-- Badge de stock --}}
                @if($producto->stock > 20)
                    <span class="badge-categoria badge-stock-ok">Stock: {{ $producto->stock }}</span>
                @elseif($producto->stock > 5)
                    <span class="badge-categoria badge-stock-warn">Stock: {{ $producto->stock }}</span>
                @else
                    <span class="badge-categoria badge-stock-low">Stock bajo: {{ $producto->stock }}</span>
                @endif
 
                <p class="precio">S/. {{ number_format($producto->precio, 2) }}</p>
            </div>
 
            <div class="card-footer">
                <span class="badge-categoria">{{ $producto->categoria->descripcion ?? 'Sin cat.' }}</span>
                <div style="display:flex; gap:.4rem">
                    <a href="{{ route('productos.show', $producto->id_producto) }}"
                       class="btn btn-outline btn-sm">Ver</a>
                    <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">+ Carrito</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
 
@endsection
