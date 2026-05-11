@extends('layouts.app')
 
@section('titulo', 'Inicio')
 
@section('contenido')
    <div class="hero">
        <h2>Bienvenido al Administrador de Productos</h2>
        <p>Gestiona tus categorías y productos desde un solo lugar.</p>
        <a href="{{ route('categorias.index') }}" class="btn">Ver Categorías</a>
        <a href="{{ route('productos.index') }}" class="btn">Ver Productos</a>
    </div>
@endsection
