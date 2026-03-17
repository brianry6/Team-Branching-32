@extends('layouts.admin')

@section('content')
<style>
    /* =========================================================
       Glassmorphic Products Page
    ========================================================= */
    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #4f46e5, #8b5cf6, #ec4899);
        color: #fff;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0; left: 0;
        width: 100%;
        height: 100%;
        background: url('/images/gym-login-bg.jpg') center/cover no-repeat;
        opacity: 0.25;
        filter: blur(8px);
        z-index: -1;
    }

    .products-container {
        max-width: 1200px;
        margin: 3rem auto;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 2rem;
        padding: 2rem;
        backdrop-filter: blur(20px);
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.25);
    }

    h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 2rem;
        text-align: center;
    }

    .btn {
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 0.75rem;
        border: none;
        cursor: pointer;
        transition: transform 0.2s, background 0.3s;
    }

    .btn:hover {
        transform: scale(1.05);
    }

    .add-btn {
        background: rgba(34,197,94,0.9);
        color: #fff;
        margin-bottom: 1rem;
        display: inline-block;
    }

    .delete-btn {
        background: rgba(239,68,68,0.9);
        color: #fff;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        overflow-x: auto;
        color: #fff;
    }

    thead {
        background: rgba(255,255,255,0.2);
    }

    th, td {
        padding: 0.75rem 1rem;
        text-align: left;
    }

    tbody tr {
        border-bottom: 1px solid rgba(255,255,255,0.3);
        transition: background 0.2s;
    }

    tbody tr:hover {
        background: rgba(255,255,255,0.05);
    }

    select {
        padding: 0.3rem 0.5rem;
        border-radius: 0.5rem;
        border: 1px solid rgba(255,255,255,0.3);
        background: rgba(255,255,255,0.1);
        color: #fff;
    }

    button {
        cursor: pointer;
    }

    @media screen and (max-width: 768px) {
        .products-container {
            padding: 1.5rem;
            margin: 1.5rem;
        }
        h1 {
            font-size: 2rem;
        }
        table {
            display: block;
            overflow-x: auto;
        }
    }
</style>

<div class="products-container">
    <h1>Products</h1>

    <a href="{{ route('admin.products.create') }}" class="btn add-btn">
        Add New Product
    </a>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->Product_name }}</td>
                    <td>{{ $product->subcategory->category->Category_name ?? '-' }}</td>
                    <td>{{ $product->subcategory->SubCategory_name ?? '-' }}</td>
                    <td>${{ $product->Price }}</td>
                    <td>{{ $product->Quantity }}</td>
                    <td>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($products->isEmpty())
                <tr>
                    <td colspan="7" style="text-align:center; padding:1rem; color:#ccc;">
                        No products found.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
