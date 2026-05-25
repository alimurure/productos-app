{{-- resources/views/productos/galeria.blade.php --}}
@extends('layouts.app')
@section('titulo', 'Galería de Productos')

@section('contenido')

<div class="galeria-header">
    <h1>
        Galería de Productos
        <span class="total-badge">{{ $productos->count() }} productos</span>
    </h1>
    <a href="{{ route('productos.index') }}" class="btn-tabla">📊 Ver como tabla</a>
</div>

{{-- SECCIÓN DE FILTROS Y BUSCADOR (Reto 1 y Reto 3) --}}
<div class="filtros-container">
    <form action="{{ url()->current() }}" method="GET" class="form-filtros">
        <div class="search-box">
            🔍 <input type="text" name="buscar" id="buscador" placeholder="Buscar producto por nombre..." value="{{ request('buscar') }}">
        </div>

        <div class="select-box">
            📁 <select name="categoria" onchange="this.form.submit()">
                <option value="">Todas las categorías</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id_categoria }}" {{ request('categoria') == $cat->id_categoria ? 'selected' : '' }}>
                        {{ $cat->descripcion }}
                    </option>
                @endforeach
            </select>
        </div>
        
        @if(request('buscar') || request('categoria'))
            <a href="{{ url()->current() }}" class="btn-limpiar">✨ Limpiar filtros</a>
        @endif
    </form>
</div>

@if($productos->isEmpty())
    <div class="alert-viva">✨ ¡Vaya! No se encontraron productos con esos filtros. ✨</div>
@else
    <div class="galeria-grid-viva">
        @foreach($productos as $producto)
        {{-- Si el stock es 0, le añadimos una clase "producto-agotado" para opacarlo visualmente --}}
        <div class="card-viva {{ $producto->stock == 0 ? 'producto-agotado' : '' }}">

            <div class="imagen-wrapper-viva">
                @if($producto->foto && file_exists(public_path('img/productos/' . $producto->foto)))
                    <img src="{{ asset('img/productos/' . $producto->foto) }}" alt="{{ $producto->nombre }}">
                @else
                    <div class="no-foto-viva">📦 Sin foto</div>
                @endif
                
                <span class="badge-cat-flotante">
                    {{ $producto->categoria->descripcion ?? 'General' }}
                </span>
            </div>

            <div class="body-viva">
                <h3>{{ $producto->nombre }}</h3>
                <p class="marca-viva">⚡ {{ $producto->marca }}</p>

                {{-- MANEJO DE BADGES DE STOCK Y RETO 2 (AGOTADO) --}}
                <div class="stock-box">
                    @if($producto->stock == 0)
                        <span class="burbuja-stock stock-agotado">❌ ¡AGOTADO!</span>
                    @elseif($producto->stock > 20)
                        <span class="burbuja-stock stock-alto">🟢 Stock: {{ $producto->stock }}</span>
                    @elseif($producto->stock > 5)
                        <span class="burbuja-stock stock-medio">🟡 Stock: {{ $producto->stock }}</span>
                    @else
                        <span class="burbuja-stock stock-bajo">💥 ¡Solo {{ $producto->stock }} left!</span>
                    @endif
                </div>

                <p class="precio-viva">S/. {{ number_format($producto->precio, 2) }}</p>
            </div>

            {{-- BOTONES Y LOGICA DE DESHABILITADO (Reto 2) --}}
            <div class="footer-viva">
                <a href="{{ route('productos.show', $producto->id_producto) }}" class="btn-vivo btn-ver">
                    👁️ Ver
                </a>
                <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST" style="margin:0; flex-grow: 1;">
                    @csrf
                    {{-- Si el stock es 0, disabled bloquea el botón --}}
                    <button type="submit" class="btn-vivo btn-carrito" {{ $producto->stock == 0 ? 'disabled' : '' }}>
                        {{ $producto->stock == 0 ? '🚫 Agotado' : '🛒 + Carrito' }}
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endif

{{-- JAVASCRIPT PARA BUSCADOR EN TIEMPO REAL (Reto 3 - Opcional con submit al dejar de escribir) --}}
<script>
    let timeout = null;
    document.getElementById('buscador').addEventListener('keyup', function() {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            this.form.submit();
        }, 600); // Envía el formulario automáticamente 600ms después de que el usuario deje de escribir
    });
</script>

<style>
    /* Agregamos los estilos de la barra de filtros a tu CSS anterior */
    .filtros-container {
        background: white;
        padding: 1rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        border: 2px solid #f1f5f9;
    }
    .form-filtros {
        display: flex;
        gap: 1rem;
        align-items: center;
        flex-wrap: wrap;
    }
    .search-box, .select-box {
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-grow: 1;
    }
    .search-box input, .select-box select {
        border: none;
        background: transparent;
        width: 100%;
        outline: none;
        font-weight: 600;
        color: #334155;
    }
    .btn-limpiar {
        color: #ef4444;
        text-decoration: none;
        font-weight: bold;
        font-size: 0.9rem;
    }
    /* Estilos del estado agotado */
    .producto-agotado {
        opacity: 0.6;
        filter: grayscale(0.4);
    }
    .stock-agotado {
        background: #f1f5f9 !important;
        color: #64748b !important;
        border: 2px solid #cbd5e1 !important;
    }
    .btn-carrito:disabled {
        background: #cbd5e1 !important;
        color: #94a3b8 !important;
        box-shadow: none !important;
        cursor: not-allowed;
    }
    
    /* (Copia y mantén aquí abajo el resto de los estilos .galeria-header, .card-viva, etc., que te pasé en la respuesta anterior) */
</style>
@endsection