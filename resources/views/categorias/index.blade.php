@extends('layouts.app')
@section('titulo', 'Categorías')
@section('contenido')
    <h1>Categorías <span style="font-size:1rem;font-weight:normal;color:#888">({{ $categorias->count() }} registros)</span></h1>
 
    @if($categorias->isEmpty())
        <p style="color:#888">No hay categorías registradas aún.</p>
    @else
        <table>
            <thead><tr><th>#</th><th>Descripción</th><th>N° Productos</th></tr></thead>
            <tbody>
                @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id_categoria }}</td>
                        <td>{{ $categoria->descripcion }}</td>
                        <td>
                            <span class="badge {{ $categoria->productos->count() > 0 ? 'badge-ok' : '' }}">
                                {{ $categoria->productos->count() }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
