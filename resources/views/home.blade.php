@extends('layouts.app')
@section('titulo', 'Inicio')
@section('contenido')
    <div class="hero">
        <h2>Bienvenido al Administrador de Productos</h2>
        @auth
            <p>Hola, <strong>{{ Auth::user()->name }}</strong>. Gestiona tus categorías y productos.</p>
        @else
            <p>Gestiona tus categorías y productos desde un solo lugar.</p>
        @endauth
 
        <div class="stats" style="justify-content: center; margin: 20px 0;">
            <div class="stat-card">
                <div class="number">{{ $totalCategorias }}</div>
                <div class="label">Categorías</div>
            </div>
            <div class="stat-card">
                <div class="number">{{ $totalProductos }}</div>
                <div class="label">Productos</div>
            </div>
        </div>
 
        <a href="{{ route('categorias.index') }}" class="btn">Ver Categorías</a>
        <a href="{{ route('productos.index') }}" class="btn">Ver Productos</a>
    </div>
@endsection
