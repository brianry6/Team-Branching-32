@extends('layouts.admin')

@section('content')
<style>
    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #4f46e5, #8b5cf6, #ec4899);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
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

    .glass-form {
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 1.5rem;
        padding: 2.5rem;
        max-width: 500px;
        width: 90%;
        color: #fff;
        backdrop-filter: blur(20px);
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.25);
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .glass-form h1 {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 2rem;
        font-weight: 700;
    }

    .glass-form label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .glass-form input {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border-radius: 0.75rem;
        border: 1px solid rgba(255,255,255,0.3);
        background: rgba(255,255,255,0.1);
        color: #fff;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .glass-form input::placeholder {
        color: rgba(255,255,255,0.7);
    }

    .glass-form input:focus {
        outline: none;
        border-color: #c7d2fe;
        background: rgba(255,255,255,0.2);
    }

    .glass-form button {
        width: 100%;
        padding: 0.75rem;
        background: rgba(59, 130, 246, 0.8);
        color: #fff;
        font-weight: 600;
        border: none;
        border-radius: 0.75rem;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
    }

    .glass-form button:hover {
        background: rgba(59, 130, 246, 0.95);
        transform: scale(1.03);
    }

    .error-message {
        color: #f87171;
        font-size: 0.875rem;
        margin-top: -0.5rem;
        margin-bottom: 1rem;
    }
</style>

<div class="glass-form">
    <h1>Add New Category</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div>
            <label for="Category_name">Category Name</label>
            <input type="text" name="Category_name" id="Category_name" placeholder="Enter category name" value="{{ old('Category_name') }}" required>
            @error('Category_name')<p class="error-message">{{ $message }}</p>@enderror
        </div>

        <button type="submit">Add Category</button>
    </form>
</div>
@endsection
