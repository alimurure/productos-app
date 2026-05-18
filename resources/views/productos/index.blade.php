@extends('layouts.app')
@section('titulo', 'Productos')
@section('contenido')
    <h1>Productos <span style="font-size:1rem;font-weight:normal;color:#888">({{ $productos->count() }} registros)</span></h1>
 
    @if($productos->isEmpty())
        <p style="color:#888">No hay productos registrados aún.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th><th>Nombre</th><th>Marca</th>
                    <th>Precio (S/.)</th><th>Stock</th><th>Categoría</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->id_producto }}</td>
                        <td><strong>{{ $producto->nombre }}</strong></td>
                        <td>{{ $producto->marca }}</td>
                        <td>S/. {{ number_format($producto->precio, 2) }}</td>
                        <td>
                            {{-- Badge de color según nivel de stock --}}
                            @if($producto->stock > 20)
                                <span class="badge badge-ok">{{ $producto->stock }}</span>
                            @elseif($producto->stock > 5)
                                <span class="badge">{{ $producto->stock }}</span>
                            @else
                                <span class="badge badge-warn">{{ $producto->stock }} ⚠</span>
                            @endif
                        </td>
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
