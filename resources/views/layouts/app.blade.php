<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos App – @yield('titulo', 'Inicio')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f6f8; color: #333; }
        nav { background: #1a73e8; padding: 14px 24px; display: flex; align-items: center; gap: 20px; }
        nav .brand { color: white; font-size: 1.2rem; font-weight: bold; text-decoration: none; }
        nav a { color: #cce0ff; text-decoration: none; font-size: 0.95rem; }
        nav a:hover { color: white; text-decoration: underline; }
        .container { max-width: 1000px; margin: 30px auto; padding: 0 20px; }
        h1 { color: #1a73e8; margin-bottom: 20px; border-bottom: 2px solid #1a73e8; padding-bottom: 8px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 6px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,0.1); }
        th { background: #1a73e8; color: white; padding: 10px 14px; text-align: left; }
        td { padding: 10px 14px; border-bottom: 1px solid #e0e0e0; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f0f7ff; }
        .badge { background: #e8f0fe; color: #1a73e8; padding: 3px 10px; border-radius: 12px; font-size: 0.85rem; }
        .hero { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.1); text-align: center; }
        .hero h2 { font-size: 1.8rem; color: #1a73e8; margin-bottom: 12px; }
        .hero p { color: #666; margin-bottom: 20px; }
        .btn { display: inline-block; background: #1a73e8; color: white; padding: 10px 22px; border-radius: 5px; text-decoration: none; margin: 6px; font-size: 0.95rem; }
        .btn:hover { background: #1558b0; }
        footer { text-align: center; padding: 20px; color: #999; font-size: 0.85rem; margin-top: 40px; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}" class="brand">🛒 Productos App</a>
        <a href="{{ route('home') }}">Inicio</a>
        <a href="{{ route('categorias.index') }}">Categorías</a>
        <a href="{{ route('productos.index') }}">Productos</a>
    </nav>
    <div class="container">
        @yield('contenido')
    </div>
    <footer>
        <p>Productos App &copy; {{ date('Y') }} – Desarrollo de Aplicaciones en Internet</p>
    </footer>
</body>
</html>
