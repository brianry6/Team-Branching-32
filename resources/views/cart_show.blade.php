@extends('layouts.app')

@section('title', 'Cart')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
<div class="cart-page container">
    <h1>Your Cart</h1>

    @php $grandTotal = 0; @endphp

    @if($products->isEmpty())
        <p>Your cart is empty.</p>
    @else
<table class="cart-table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Image</th>
            <th>Quantity</th>
            <th>Unit Price (£)</th>
            <th>Total (£)</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            @php
                $quantity = $product->pivot->Product_quantity ?? ($sessionCart[$product->Product_ID] ?? 1);
                $total = $product->Price * $quantity;
            @endphp
            <tr>
                <td>{{ $product->Product_name }}</td>
                <td>
                    @if($product->Product_image)
                        <img src="{{ asset('images/'.$product->Product_image) }}" 
                             alt="{{ $product->Product_name }}" 
                             style="width: 80px; height: auto;">
                    @else
                        <span>No image</span>
                    @endif
                </td>
                <td>{{ $quantity }}</td>
                <td>£{{ number_format($product->Price, 2) }}</td>
                <td>£{{ number_format($total, 2) }}</td>
                <td>
                    <form action="{{ route('cart.remove', $product->Product_ID) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-remove">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

        <div class="grand-total">
            Grand Total: £{{ number_format($grandTotal, 2) }}
        </div>

        <div class="bottom-buttons">
            <a href="{{ url('/') }}" class="btn btn-primary">Continue Shopping</a>
            <a class="btn btn-primary" id="checkoutBtn">Proceed to Checkout</a>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/cart.js') }}"></script>
@endsection