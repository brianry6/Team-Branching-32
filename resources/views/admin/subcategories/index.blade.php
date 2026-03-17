@extends('layouts.admin')

@section('content')
<style>
/* =========================================================
   Glassmorphic Subcategories Page
========================================================= */
body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #4f46e5, #8b5cf6, #ec4899);
    min-height: 100vh;
    margin: 0;
    display: flex;
    justify-content: center;
    padding: 2rem;
    position: relative;
}

body::before {
    content: '';
    position: fixed;
    top:0; left:0;
    width: 100%;
    height: 100%;
    background: url('/images/gym-login-bg.jpg') center/cover no-repeat;
    opacity: 0.25;
    filter: blur(8px);
    z-index: -1;
}

/* Glass container */
.glass-container {
    width: 100%;
    max-width: 900px;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 2rem;
    box-shadow: 0 8px 32px rgba(31,38,135,0.25);
    backdrop-filter: blur(20px);
    padding: 2rem;
    color: #fff;
    animation: fadeIn 0.8s ease-in-out;
}

/* Smooth fade-in */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
}

h2 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

/* Back button */
.back-btn {
    display: inline-block;
    background: rgba(107,114,128,0.8);
    padding: 0.5rem 1rem;
    border-radius: 1rem;
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    transition: transform 0.2s, background 0.3s;
}
.back-btn:hover {
    background: rgba(107,114,128,0.95);
    transform: scale(1.05);
}

/* Add subcategory form */
.add-form {
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 1.5rem;
    padding: 1.5rem;
    margin-bottom: 2rem;
}

.add-form input[type="text"] {
    flex: 1;
    padding: 0.5rem 1rem;
    border: 1px solid rgba(255,255,255,0.3);
    border-radius: 1rem;
    background: rgba(255,255,255,0.1);
    color: #fff;
    margin-right: 0.5rem;
    font-size: 1rem;
    outline: none;
    transition: all 0.3s;
}

.add-form input::placeholder {
    color: rgba(255,255,255,0.7);
}

.add-form input:focus {
    border-color: rgba(147,197,253,0.8);
    background: rgba(255,255,255,0.2);
}

.add-form button {
    padding: 0.5rem 1.5rem;
    border-radius: 1rem;
    border: none;
    background: rgba(34,197,94,0.8);
    color: #fff;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.2s, background 0.3s;
}

.add-form button:hover {
    background: rgba(34,197,94,0.95);
    transform: scale(1.05);
}

/* Error message */
.error-message {
    color: #fecaca;
    background: rgba(239,68,68,0.15);
    padding: 0.5rem;
    border-radius: 0.75rem;
    margin-top: 0.5rem;
    font-size: 0.875rem;
}

/* Table styles */
.table-wrapper {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 600px;
}

thead {
    background: rgba(255,255,255,0.3);
}

th, td {
    padding: 0.75rem 1rem;
    text-align: left;
}

th {
    font-weight: 600;
}

tbody tr {
    border-bottom: 1px solid rgba(255,255,255,0.2);
    transition: background 0.3s;
}

tbody tr:hover {
    background: rgba(255,255,255,0.1);
}

/* Delete button in table */
.delete-btn {
    background: rgba(239,68,68,0.8);
    border: none;
    border-radius: 1rem;
    padding: 0.25rem 1rem;
    color: #fff;
    font-weight: 500;
    cursor: pointer;
    transition: transform 0.2s, background 0.3s;
}

.delete-btn:hover {
    background: rgba(239,68,68,0.95);
    transform: scale(1.05);
}

/* Responsive */
@media screen and (max-width: 768px) {
    .add-form {
        flex-direction: column;
    }

    .add-form input[type="text"] {
        margin-right: 0;
        margin-bottom: 0.5rem;
        width: 100%;
    }

    .table-wrapper table {
        min-width: 100%;
    }
}
</style>

<div class="glass-container">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
        <h1>Subcategories for: {{ $category->Category_name }}</h1>
        <a href="{{ route('admin.categories.index') }}" class="back-btn">Back to Categories</a>
    </div>

    <!-- Add Subcategory Form -->
    <div class="add-form">
        <h2>Add New Subcategory</h2>
        <form action="{{ route('admin.categories.subcategories.store', ['categoryId' => $category->Category_ID]) }}" method="POST">
            @csrf
            <div style="display:flex; gap:0.5rem;">
                <input type="text" name="SubCategory_name" placeholder="Enter subcategory name" required>
                <button type="submit">Add Subcategory</button>
            </div>
            @error('SubCategory_name')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </form>
    </div>

    <!-- Subcategories List -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subcategory Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category->subcategories as $subcategory)
                <tr>
                    <td>{{ $subcategory->SubCategory_ID }}</td>
                    <td>{{ $subcategory->SubCategory_name }}</td>
                    <td>
                        <form action="{{ route('admin.categories.subcategories.destroy', [$category->Category_ID, $subcategory->SubCategory_ID ]) }}" 
                              method="POST" onsubmit="return confirm('Delete this subcategory?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($category->subcategories->isEmpty())
                <tr>
                    <td colspan="3" style="text-align:center; color:rgba(255,255,255,0.7); padding:1rem;">
                        No subcategories found. Add your first subcategory above.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
