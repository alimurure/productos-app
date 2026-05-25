@extends('layouts.app')
@section('titulo', 'Pedido Confirmado')

@section('contenido')
<div class="confirmacion-wrapper">
    <div class="ticket-card">
        <div class="check-icon">🎉</div>
        <h2>¡Pedido Confirmado con Éxito!</h2>
        <p class="gracias">Gracias por tu compra en nuestra tienda.</p>
        
        <div class="ticket-detalles">
            <p><strong>👤 Cliente:</strong> {{ Auth::user() ? Auth::user()->name : 'Invitado de Honor' }}</p>
            <p><strong>📅 Fecha de Emisión:</strong> {{ now()->format('d/m/Y H:i A') }}</p>
            <p><strong>💰 Total Pagado:</strong> <span class="total-precio">S/. {{ number_format($total, 2) }}</span></p>
            <p><strong>🆔 Código de Operación:</strong> #{{ rand(100000, 999999) }}</p>
        </div>

        <a href="{{ route('productos.galeria') }}" class="btn-volver-tienda">✨ Seguir Comprando</a>
    </div>
</div>

<style>
    .confirmacion-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 3rem 1rem;
        font-family: 'Segoe UI', sans-serif;
    }
    .ticket-card {
        background: white;
        border: 3px solid #bbf7d0;
        padding: 2.5rem;
        border-radius: 24px;
        text-align: center;
        box-shadow: 0 15px 30px rgba(22, 163, 74, 0.08);
        max-width: 450px;
        width: 100%;
    }
    .check-icon {
        font-size: 3.5rem;
        margin-bottom: 1rem;
    }
    .ticket-card h2 { color: #16a34a; margin: 0 0 0.5rem 0; font-weight: 800; }
    .gracias { color: #64748b; margin-bottom: 2rem; }
    .ticket-detalles {
        background: #f8fafc;
        border: 2px dashed #e2e8f0;
        padding: 1.5rem;
        border-radius: 16px;
        text-align: left;
        margin-bottom: 2rem;
    }
    .ticket-detalles p { margin: 0 0 0.75rem 0; color: #334155; font-size: 0.95rem; }
    .ticket-detalles p:last-child { margin: 0; }
    .total-precio { color: #2563eb; font-weight: 800; font-size: 1.1rem; }
    .btn-volver-tienda {
        display: inline-block;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white !important;
        text-decoration: none;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: bold;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }
</style>
@endsection