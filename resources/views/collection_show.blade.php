@extends('layouts.app')

@section('title', $category->Category_name)

@section('styles')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="container">
    <h1 class="text-3xl font-bold mb-6">{{ $category->Category_name }}</h1>

    @foreach($groupedProducts as $subcategoryName => $products)
        <section class="subcategory-section mb-12">
            <h2 class="text-2xl font-semibold mb-4">{{ $subcategoryName }}</h2>

            <div class="product-grid">
                @foreach($products as $product)
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
                @endforeach
            </div>
        </section>
    @endforeach
</div>
@endsection