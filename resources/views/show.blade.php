@extends('layouts.app')

@section('title', $product->Product_name)

@section('styles')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="product-container container">
    <div class="product-image-grid">
        <img src="{{ asset('images/'.$product->Product_image) }}" alt="{{ $product->Product_name }}">
        <img src="{{ asset('images/'.$product->Product_image) }}" alt="{{ $product->Product_name }}">
        <img src="{{ asset('images/'.$product->Product_image) }}" alt="{{ $product->Product_name }}">
        <img src="{{ asset('images/'.$product->Product_image) }}" alt="{{ $product->Product_name }}">

    </div>

    <div class="product-details">
        <h1>{{ $product->Product_name }}</h1>
        <p class="price">£{{ number_format($product->Price, 2) }}</p>

@php
$groupedSpecs = $product->specifications->groupBy('Spec_name');
@endphp

@foreach($groupedSpecs as $specName => $specValues)
    <h3>{{ $specName }}</h3>
    <div class="option-group">
        @foreach($specValues as $spec)
            <label class="option-btn">
                <input type="radio" name="spec_{{ $spec->Spec_ID }}" value="{{ $spec->pivot->Spec_value }}">
                <span>{{ $spec->pivot->Spec_value }}</span>
            </label>
        @endforeach
    </div>
@endforeach
        <form action="{{ route('cart.add') }}" method="POST" class="full-width-btn">
            @csrf
            <div class="button-wrapper">
            <input type="hidden" name="product_id" value="{{ $product->Product_ID }}">
            <button type="submit" class="btn btn-primary">Add to Basket</button>
        </form>
                <form action="{{ route('cart.add') }}" method="POST" class="full-width-btn">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->Product_ID }}">
            <button type="submit" class="btn btn-secondary">Add to Wishlist</button>
        </form>
</div>
    </div>
</div>
@endsection