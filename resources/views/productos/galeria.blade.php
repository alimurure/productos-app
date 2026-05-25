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

            {{-- CONTENEDOR DE IMAGEN CORREGIDO --}}
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

{{-- JAVASCRIPT PARA BUSCADOR EN TIEMPO REAL (Reto 3) --}}
<script>
    let timeout = null;
    document.getElementById('buscador').addEventListener('keyup', function() {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            this.form.submit();
        }, 600);
    });
</script>

<style>
    /* Estilos base de la estructura y Grid */
    .galeria-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        background: linear-gradient(135deg, #e0f2fe 0%, #f0fdf4 100%);
        padding: 1.5rem;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        border: 2px solid #bae6fd;
    }

    .galeria-header h1 {
        margin: 0;
        font-family: 'Segoe UI', system-ui, sans-serif;
        color: #0369a1;
        font-size: 2.2rem;
        font-weight: 800;
    }

    .total-badge {
        font-size: 1rem;
        background: #0ea5e9;
        color: #fff;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-weight: bold;
    }

    .btn-tabla {
        background: linear-gradient(135deg, #a855f7 0%, #7c3aed 100%);
        color: white !important;
        text-decoration: none;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: bold;
    }

    /* FILTROS */
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

    /* GRID RESPONSIVO SEGURO */
    .galeria-grid-viva {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        padding: 10px 5px;
    }

    /* ESTRUCTURA UNIFORME DE LAS TARJETAS */
    .card-viva {
        background: #ffffff;
        border: 3px solid #f1f5f9;
        border-radius: 24px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Fuerza el balance de contenido alto/bajo */
        height: 100%; /* Obliga a que todas midan lo mismo en su fila */
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .card-viva:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 20px 35px rgba(14, 165, 233, 0.15);
        border-color: #38bdf8;
    }

    /* 🛡️ CORRECCIÓN DE IMÁGENES REBELDES (TAMAÑO FIJO CON OBJECT-FIT) */
    .imagen-wrapper-viva {
        width: 100%;
        height: 200px; /* Altura idéntica para todas las zonas de fotos */
        position: relative;
        overflow: hidden;
        background: #f8fafc;
        border-bottom: 2px solid #f1f5f9;
    }

    .imagen-wrapper-viva img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Recorta y acomoda proporcionalmente sin estirar */
        object-position: center; /* Centra el enfoque de la fotografía */
        transition: transform 0.5s ease;
    }

    .card-viva:hover .imagen-wrapper-viva img {
        transform: scale(1.08);
    }

    .no-foto-viva {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e2e8f0;
        color: #64748b;
        font-weight: bold;
    }

    .badge-cat-flotante {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(15, 23, 42, 0.8);
        color: #38bdf8;
        padding: 0.3rem 0.8rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    /* CUERPO DE CONTENIDO */
    .body-viva {
        padding: 1.25rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: min-content;
        text-align: center;
    }

    .body-viva h3 {
        margin: 0 0 0.4rem 0;
        font-size: 1.3rem;
        color: #0f172a;
        font-weight: 700;
    }

    .marca-viva {
        margin: 0 0 0.8rem 0;
        font-size: 0.85rem;
        color: #64748b;
        font-weight: 600;
    }

    /* BURBUJAS DE STOCK */
    .stock-box {
        margin-bottom: 0.8rem;
        height: 28px; /* Reserva espacio para que la alineación no salte */
    }

    .burbuja-stock {
        font-size: 0.8rem;
        font-weight: 700;
        padding: 0.3rem 0.8rem;
        border-radius: 12px;
        display: inline-block;
    }

    .stock-alto { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .stock-medio { background: #fef9c3; color: #854d0e; border: 1px solid #fef08a; }
    .stock-bajo { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
    .stock-agotado { background: #cbd5e1; color: #475569; border: 1px solid #94a3b8; }

    .precio-viva {
        margin: 0.5rem 0 0 0;
        font-size: 1.6rem;
        font-weight: 800;
        background: linear-gradient(135deg, #ea580c 0%, #ff8200 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* BOTONES */
    .footer-viva {
        padding: 0 1.25rem 1.25rem 1.25rem;
        display: flex;
        gap: 0.6rem;
    }

    .btn-vivo {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.65rem 1rem;
        border-radius: 14px;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        border: none;
        text-decoration: none;
        transition: transform 0.2s;
    }

    .btn-ver {
        background: #f1f5f9;
        color: #334155;
        border: 2px solid #e2e8f0;
    }

    .btn-carrito {
        background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%);
        color: white;
        flex-grow: 1;
    }

    .btn-carrito:hover:not(:disabled) {
        transform: scale(1.03);
    }

    /* ESTADOS AGOTADOS */
    .producto-agotado {
        opacity: 0.75;
    }

    .btn-carrito:disabled {
        background: #e2e8f0 !important;
        color: #94a3b8 !important;
        cursor: not-allowed;
    }

    .alert-viva {
        background: #fef3c7;
        color: #d97706;
        border: 2px dashed #fcd34d;
        padding: 2rem;
        border-radius: 20px;
        text-align: center;
        font-weight: bold;
    }
</style>
@endsection