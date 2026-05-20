@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Categorias --}}
    <div class="categories">
        <a href="{{ route('products.index') }}"
           class="cat-pill {{ $selectedCategory === 'todos' ? 'active' : '' }}">
            Todos
        </a>
        @foreach($categories as $category)
            <a href="{{ route('products.index', ['category' => $category->slug]) }}"
               class="cat-pill {{ $selectedCategory === $category->slug ? 'active' : '' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    {{-- Título --}}
    <div class="section-header">
        <h2>Nosso Menu</h2>
        <p>Escolha seus pratos favoritos e aproveite!</p>
    </div>

    {{-- Grid de produtos --}}
    <div class="products-grid">
        @forelse($products as $product)
            <div class="product-card">
                <div class="product-img">
                    @if($product->image && file_exists(public_path('images/' . $product->image)))
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div class="product-img-placeholder">🍔</div>
                    @endif
                </div>
                <div class="product-info">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <p class="product-desc">{{ $product->description }}</p>
                    <div class="product-footer">
                        <span class="product-price">{{ $product->price }} KZ</span>
                        <button class="add-btn" onclick="addToCart({{ $product->id }}, '{{ $product->name }}')" aria-label="Adicionar {{ $product->name }}">
                            +
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <p class="empty-state">Nenhum produto encontrado nesta categoria.</p>
        @endforelse
    </div>

</div>
@endsection
