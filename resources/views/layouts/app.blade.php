<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'ProductosApp') | DAI</title>
    <style>
        /* ── Variables CSS globales ── */
        :root {
            --primary:    #C0392B;
            --primary-dk: #922B21;
            --accent:     #E74C3C;
            --bg:         #F4F6F7;
            --card-bg:    #FFFFFF;
            --text:       #2C3E50;
            --text-light: #7F8C8D;
            --border:     #D5D8DC;
            --radius:     10px;
            --shadow:     0 4px 16px rgba(0,0,0,.10);
        }
 
        /* ── Reset y base ── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: var(--bg);
               color: var(--text); min-height: 100vh; }
        a { color: var(--primary); text-decoration: none; }
        a:hover { color: var(--primary-dk); text-decoration: underline; }
 
        /* ── Navbar ── */
        .navbar {
            background: var(--primary-dk);
            padding: .8rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,.2);
        }
        .navbar .brand { color:#fff; font-size:1.3rem; font-weight:700; letter-spacing:.5px; }
        .navbar .brand span { color:#F1948A; }
        .navbar nav a {
            color: rgba(255,255,255,.85); margin-left:1.2rem;
            font-size:.95rem; font-weight:500; transition: color .2s;
        }
        .navbar nav a:hover { color:#fff; text-decoration:none; }
        .navbar .carrito-btn {
            background: var(--accent); color:#fff; border:none;
            padding:.45rem 1rem; border-radius:20px; cursor:pointer;
            font-size:.9rem; font-weight:600; transition: background .2s;
        }
        .navbar .carrito-btn:hover { background: var(--primary); }
 
        /* ── Contenido principal ── */
        .main-content { max-width: 1200px; margin: 2rem auto; padding: 0 1.5rem; }
 
        /* ── Tarjetas ── */
        .card {
            background: var(--card-bg); border-radius: var(--radius);
            box-shadow: var(--shadow); padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
 
        /* ── Botones ── */
        .btn {
            display: inline-block; padding: .55rem 1.3rem;
            border-radius: 6px; font-weight: 600; font-size: .9rem;
            cursor: pointer; border: none; transition: all .2s;
        }
        .btn-primary { background: var(--primary); color:#fff; }
        .btn-primary:hover { background: var(--primary-dk); color:#fff; text-decoration:none; }
        .btn-success { background: #27AE60; color:#fff; }
        .btn-success:hover { background: #1E8449; color:#fff; text-decoration:none; }
        .btn-danger  { background: #C0392B; color:#fff; }
        .btn-outline { background:transparent; border:2px solid var(--primary); color:var(--primary); }
        .btn-outline:hover { background:var(--primary); color:#fff; text-decoration:none; }
        .btn-sm { padding:.35rem .85rem; font-size:.82rem; }
 
        /* ── Galeria de productos ── */
        .galeria-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        .producto-card {
            background: var(--card-bg); border-radius: var(--radius);
            box-shadow: var(--shadow); overflow: hidden;
            transition: transform .25s, box-shadow .25s;
            display: flex; flex-direction: column;
        }
        .producto-card:hover { transform: translateY(-6px);
            box-shadow: 0 10px 28px rgba(0,0,0,.15); }
        .producto-card img {
            width: 100%; height: 200px; object-fit: cover;
        }
        .producto-card .no-foto {
            width:100%; height:200px; background:#ECF0F1;
            display:flex; align-items:center; justify-content:center;
            color: var(--text-light); font-size:.9rem;
        }
        .producto-card .card-body {
            padding: 1rem; flex-grow:1; display:flex; flex-direction:column;
        }
        .producto-card .card-body h3 { font-size:1rem; margin-bottom:.3rem; }
        .producto-card .card-body .marca { color:var(--text-light); font-size:.85rem; margin-bottom:.6rem; }
        .producto-card .card-body .precio {
            font-size:1.25rem; font-weight:700; color:var(--primary); margin-top:auto;
        }
        .producto-card .card-footer {
            padding: .8rem 1rem; border-top:1px solid var(--border);
            display:flex; gap:.5rem; justify-content:space-between; align-items:center;
        }
        .badge-categoria {
            background:#FADBD8; color:var(--primary-dk); padding:.25rem .65rem;
            border-radius:20px; font-size:.78rem; font-weight:600;
        }
        .badge-stock-ok   { background:#D5F5E3; color:#1E8449; }
        .badge-stock-warn { background:#FDEBD0; color:#E67E22; }
        .badge-stock-low  { background:#FADBD8; color:#C0392B; }
 
        /* ── Tablas ── */
        table { width:100%; border-collapse:collapse; margin-top:1rem; }
        th { background:var(--primary-dk); color:#fff; padding:.7rem 1rem; text-align:left; font-size:.9rem; }
        td { padding:.65rem 1rem; border-bottom:1px solid var(--border); font-size:.92rem; }
        tr:hover td { background:#FDFEFE; }
 
        /* ── Alertas ── */
        .alert { padding:.9rem 1.2rem; border-radius:var(--radius); margin-bottom:1rem; font-size:.95rem; }
        .alert-success { background:#D5F5E3; border-left:4px solid #27AE60; color:#1E8449; }
        .alert-danger  { background:#FADBD8; border-left:4px solid #C0392B; color:#922B21; }
        .alert-info    { background:#D6EAF8; border-left:4px solid #2E86C1; color:#1A5276; }
 
        /* ── Formularios ── */
        .form-group { margin-bottom: 1.2rem; }
        .form-group label { display:block; font-weight:600; margin-bottom:.4rem; font-size:.92rem; }
        .form-group input, .form-group select, .form-group textarea {
            width:100%; padding:.6rem .9rem; border:1.5px solid var(--border);
            border-radius:6px; font-size:.95rem; transition: border-color .2s;
        }
        .form-group input:focus, .form-group select:focus {
            outline:none; border-color:var(--primary);
        }
        .form-error { color:#C0392B; font-size:.83rem; margin-top:.3rem; }
 
        /* ── Footer ── */
        .site-footer {
            text-align:center; padding:1.5rem; margin-top:3rem;
            color:var(--text-light); font-size:.85rem;
            border-top:1px solid var(--border);
        }
    </style>
    @stack('styles')
</head>
<body>
 
<!-- Navbar -->
<div class="navbar">
    <a href="{{ route('home') }}" class="brand">Productos<span>App</span></a>
    <nav>
        @auth
            <a href="{{ route('productos.galeria') }}">Galeria</a>
            <a href="{{ route('productos.index') }}">Productos</a>
            <a href="{{ route('categorias.index') }}">Categorias</a>
            <a href="{{ route('carrito.index') }}" class="carrito-btn">
                Carrito
                @if(session('carrito') && count(session('carrito')) > 0)
                    ({{ count(session('carrito')) }})
                @endif
            </a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="btn btn-outline" style="margin-left:1rem">
                    Cerrar sesion
                </button>
            </form>
        @else
            <a href="{{ route('login') }}">Iniciar sesion</a>
        @endauth
    </nav>
</div>
 
<!-- Contenido principal -->
<div class="main-content">
 
    {{-- Mensajes flash de sesion --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif
 
    @yield('contenido')
</div>
 
<div class="site-footer">
    Desarrollo de Aplicaciones en Internet &mdash; Ciclo III &mdash; {{ date('Y') }}
</div>
 
@stack('scripts')
</body>
</html>
