@extends('layouts.app')

@section('title', 'ATHLETIQ')

@section('content')
   

<header>
    <div class="header-content">
        <h1>ELEVATE YOUR<br><span class="highlight">PERFORMANCE</span></h1>
        <p>Discover our latest collection of athletic<br>wear designed for champions.</p>
        <div class="hero-buttons">
        <a href="#featured-products" class="cta-btn">
  <span class="btn-text">Shop Now</span>
</a>
</div>
    </div>  
</header>

<main>
    <section id="featured-products" class="featured-products">
    <div class="container">
        <h2>Featured Products</h2>
        <p>Check out some of our hottest products this season!</p>
    
  <div class="product-grid">
@foreach($featuredProducts as $product)
<a href="{{ route('product.show', $product->Product_ID) }}" class="product-card-link">
<div class="product-card">
    <img src="{{ asset('images/' . $product->Product_image) }}" alt="{{ $product->Product_name }}">
    <div class="product-info">
        <h3>{{ $product->Product_name }}</h3>
        <p>£{{ $product->Price }}</p>
    </div>
</div>
</a>
@endforeach
        </div>
    </div>
</section>

<section class="collections">
    <div class="container">
        <h2>Collections</h2>
        <p>Explore our curated collections designed for every athlete.</p>

  <div class="product-grid">
@foreach ($categories as $category)
<a href="{{ route('category.show', $category->Category_ID) }}" class="product-card">
            <div class="product-card">
                <img src="{{ asset('images/categories/' . $category->image) }}" alt="{{ $category->name }}">
                <div class="product-info">
                    <h3>{{ $category->Category_name }}</h3>
                </div>
            </div>
</a>
@endforeach
        </div>
    </div>
</section>

<section class="collections-2">
    <div class="container">
        <h2>Collections</h2>
        <p>Explore our curated collections designed for every athlete.</p>

  <div class="product-grid">
@foreach($featuredProducts as $product)
<div class="product-card">
    <img src="{{ asset('images/' . $product->Product_image) }}" alt="{{ $product->Product_name }}">
    <div class="product-info">
        <h3>{{ $product->Product_name }}</h3>
        <p>£{{ $product->Price }}</p>
    </div>
</div>
@endforeach
        </div>
    </div>
</section>

</main>




<script src="{{ asset('js/script.js') }}"></script>
@endsection