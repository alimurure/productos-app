@extends('layouts.app')
 
@section('titulo', 'Productos')
 
@section('contenido')
    <h1>Productos</h1>
 
    @if($productos->isEmpty())
        <p>No hay productos registrados aún.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Precio (S/.)</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->id_producto }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->marca }}</td>
                        <td>{{ number_format($producto->precio, 2) }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>
                            <span class="badge">
                                {{ $producto->categoria->descripcion ?? 'Sin categoría' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
