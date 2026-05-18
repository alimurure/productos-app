<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos App – @yield('titulo', 'Inicio')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f6f8; color: #333; }
        nav { background: #1a73e8; padding: 12px 24px; display: flex;
              align-items: center; justify-content: space-between; }
        .nav-left { display: flex; align-items: center; gap: 20px; }
        .nav-right { display: flex; align-items: center; gap: 12px; }
        nav .brand { color: white; font-size: 1.1rem; font-weight: bold; text-decoration: none; }
        nav a { color: #cce0ff; text-decoration: none; font-size: 0.95rem; }
        nav a:hover { color: white; text-decoration: underline; }
        .nav-user { color: #e8f0fe; font-size: 0.88rem; }
        .btn-logout { background: rgba(255,255,255,0.15); color: white; border: 1px solid rgba(255,255,255,0.4);
                      padding: 5px 14px; border-radius: 4px; cursor: pointer;
                      font-size: 0.88rem; text-decoration: none; }
        .btn-logout:hover { background: rgba(255,255,255,0.25); color: white; }
        .container { max-width: 1000px; margin: 30px auto; padding: 0 20px; }
        h1 { color: #1a73e8; margin-bottom: 20px; border-bottom: 2px solid #1a73e8; padding-bottom: 8px; }
        table { width: 100%; border-collapse: collapse; background: white;
                border-radius: 6px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,0.1); }
        th { background: #1a73e8; color: white; padding: 10px 14px; text-align: left; }
        td { padding: 10px 14px; border-bottom: 1px solid #e0e0e0; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f0f7ff; }
        .badge { background: #e8f0fe; color: #1a73e8; padding: 3px 10px; border-radius: 12px; font-size: 0.85rem; }
        .badge-ok { background: #e8f5e9; color: #2e7d32; }
        .badge-warn { background: #fff3e0; color: #e65100; }
        .hero { background: white; padding: 40px; border-radius: 8px;
                box-shadow: 0 1px 4px rgba(0,0,0,0.1); text-align: center; }
        .hero h2 { font-size: 1.8rem; color: #1a73e8; margin-bottom: 12px; }
        .hero p { color: #666; margin-bottom: 20px; }
        .btn { display: inline-block; background: #1a73e8; color: white;
               padding: 10px 22px; border-radius: 5px; text-decoration: none; margin: 6px; }
        .btn:hover { background: #1558b0; }
        .stats { display: flex; gap: 16px; margin-bottom: 24px; flex-wrap: wrap; }
        .stat-card { background: white; border-radius: 8px; padding: 20px 28px;
                     box-shadow: 0 1px 4px rgba(0,0,0,0.1); flex: 1; min-width: 140px; text-align: center; }
        .stat-card .number { font-size: 2rem; font-weight: bold; color: #1a73e8; }
        .stat-card .label { color: #666; font-size: 0.88rem; }
        .alert-flash { padding: 12px 16px; border-radius: 6px; margin-bottom: 18px; font-size: 0.9rem; }
        .alert-success { background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
        .alert-danger  { background: #fdecea; color: #c62828; border: 1px solid #ef9a9a; }
        .alert-info    { background: #e3f2fd; color: #1565c0; border: 1px solid #90caf9; }
        footer { text-align: center; padding: 20px; color: #999; font-size: 0.85rem; margin-top: 40px; }
    </style>
</head>
<body>
    <nav>
        <div class="nav-left">
            <a href="{{ route('home') }}" class="brand">🛒 Productos App</a>
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('categorias.index') }}">Categorías</a>
            <a href="{{ route('productos.index') }}">Productos</a>
        </div>
        <div class="nav-right">
            @auth
                <span class="nav-user">👤 {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="margin:0">
                    @csrf
                    <button type="submit" class="btn-logout">Cerrar Sesión</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-logout">Iniciar Sesión</a>
            @endauth
        </div>
    </nav>
    <div class="container">
        {{-- Mensajes flash de sesión --}}
        @if(session('success'))
            <div class="alert-flash alert-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('info'))
            <div class="alert-flash alert-info">ℹ️ {{ session('info') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-flash alert-danger">❌ {{ session('error') }}</div>
        @endif
 
        @yield('contenido')
    </div>
    <footer>
        <p>Productos App &copy; {{ date('Y') }} – Desarrollo de Aplicaciones en Internet</p>
    </footer>
</body>
</html>
