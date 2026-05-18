<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión – Productos App</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
               min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-box { background: white; border-radius: 10px; padding: 40px;
                     width: 380px; box-shadow: 0 8px 32px rgba(0,0,0,0.2); }
        .login-box h1 { color: #1a73e8; font-size: 1.5rem; text-align: center; margin-bottom: 8px; }
        .login-box .subtitle { color: #888; font-size: 0.9rem; text-align: center; margin-bottom: 28px; }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-size: 0.85rem; color: #555; margin-bottom: 6px; font-weight: bold; }
        input[type=email], input[type=password] {
            width: 100%; padding: 10px 12px; border: 1px solid #ddd;
            border-radius: 6px; font-size: 0.95rem; transition: border-color 0.2s; }
        input:focus { outline: none; border-color: #1a73e8; box-shadow: 0 0 0 2px rgba(26,115,232,0.15); }
        .input-error { border-color: #e53935 !important; }
        .error-msg { color: #e53935; font-size: 0.8rem; margin-top: 4px; }
        .alert { padding: 10px 14px; border-radius: 6px; margin-bottom: 18px; font-size: 0.9rem; }
        .alert-danger { background: #fdecea; color: #c62828; border: 1px solid #ef9a9a; }
        .alert-success { background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
        .alert-info { background: #e3f2fd; color: #1565c0; border: 1px solid #90caf9; }
        .btn-login { width: 100%; background: #1a73e8; color: white; border: none;
                     padding: 12px; border-radius: 6px; font-size: 1rem;
                     cursor: pointer; font-weight: bold; margin-top: 8px; }
        .btn-login:hover { background: #1558b0; }
        .hint { background: #f8f9fa; border-radius: 6px; padding: 12px; margin-top: 20px;
                font-size: 0.82rem; color: #666; border-left: 3px solid #1a73e8; }
        .hint strong { color: #1a73e8; }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>🛒 Productos App</h1>
        <p class="subtitle">Ingrese sus credenciales para continuar</p>
 
        {{-- Mensajes de sesión (éxito, info) --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif
 
        {{-- Error general de credenciales --}}
        @if($errors->has('email') && !$errors->has('password'))
            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
        @endif
 
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
 
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       class="{{ $errors->has('email') ? 'input-error' : '' }}"
                       placeholder="ejemplo@correo.com">
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>
 
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password"
                       class="{{ $errors->has('password') ? 'input-error' : '' }}"
                       placeholder="••••••••">
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>
 
            <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>
 
        <div class="hint">
            <strong>Credenciales de prueba:</strong><br>
            Admin: admin@productosapp.com / admin123<br>
            Demo:  demo@productosapp.com  / demo123
        </div>
    </div>
</body>
</html>
