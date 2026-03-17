@extends('layouts.app')

@section('title', 'ATHLETIQ')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')

<h2>Results for "{{ $search }}"</h2>

@if($products->count() > 0)
    @foreach($products as $product)
    @endforeach
@else
    <p>No products found.</p>
@endif
<section>
<div class="container">
            <div class="product-grid">
                @foreach($products as $product)
                <a href="{{ route('product.show', $product->Product_ID) }}" class="product-card-link">
                    <div class="product-card">
                        <div class="product-image-grid">
                        <img src="{{ asset('images/' . $product->Product_image) }}" alt="{{ $product->Product_name }}">                        </div>
                        <div class="product-details">
                            <h3>{{ $product->Product_name }}</h3>
                            <p class="price">£{{ number_format($product->Price, 2) }}</p>
                            <form action="{{ route('cart.add') }}" method="POST" class="full-width-btn">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->Product_ID }}">
                                <button type="submit" class="btn btn-primary">Add to Basket</button>
                            </form>
                        </div>
                    </div>
                    </a>
                @endforeach
            </div>
</section>

@endsection