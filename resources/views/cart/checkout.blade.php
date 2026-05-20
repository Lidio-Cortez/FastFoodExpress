@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="page-title">Finalizar Pedido</h2>

    <div class="checkout-layout">
        {{-- Resumo do pedido --}}
        <div class="order-summary">
            <h3>Resumo do Pedido</h3>
            @foreach($items as $item)
                <div class="summary-item">
                    <span>{{ $item['quantity'] }}× {{ $item['product']->name }}</span>
                    <span>{{ number_format($item['subtotal'], 2, ',', '.') }} Kz</span>
                </div>
            @endforeach
            <div class="summary-total">
                <strong>Total</strong>
                <strong>{{ number_format($total, 2, ',', '.') }} Kz</strong>
            </div>
        </div>

        {{-- Formulário --}}
        <form action="{{ route('orders.store') }}" method="POST" class="checkout-form">
            @csrf
            <h3>Dados de Entrega</h3>

            <div class="form-group">
                <label for="customer_name">Nome completo</label>
                <input type="text" id="customer_name" name="customer_name"
                       value="{{ old('customer_name') }}" placeholder="O seu nome" required>
                @error('customer_name')<span class="error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="customer_phone">Telefone</label>
                <input type="tel" id="customer_phone" name="customer_phone"
                       value="{{ old('customer_phone') }}" placeholder="+244 9XX XXX XXX" required>
                @error('customer_phone')<span class="error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="customer_address">Morada de entrega</label>
                <textarea id="customer_address" name="customer_address" rows="3"
                          placeholder="Rua, número, bairro..." required>{{ old('customer_address') }}</textarea>
                @error('customer_address')<span class="error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="notes">Observações (opcional)</label>
                <textarea id="notes" name="notes" rows="2"
                          placeholder="Sem cebola, sem picante...">{{ old('notes') }}</textarea>
            </div>

            <button type="submit" class="btn-primary btn-block">Confirmar Pedido</button>
        </form>
    </div>
</div>
@endsection
