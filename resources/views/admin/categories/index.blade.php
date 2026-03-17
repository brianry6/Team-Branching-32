@extends('layouts.admin')

@section('content')
<style>
/* =========================================================
   Glassmorphic Admin Categories Page
========================================================= */
body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #4f46e5, #8b5cf6, #ec4899);
    min-height: 100vh;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: flex-start;
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
    max-width: 1200px;
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 2rem;
    box-shadow: 0 8px 32px rgba(31, 38, 135, 0.25);
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
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 2rem;
}

.add-button {
    display: inline-block;
    margin-bottom: 1.5rem;
    padding: 0.5rem 1rem;
    background: rgba(34,197,94,0.8);
    border-radius: 1rem;
    color: #fff;
    font-weight: 600;
    text-decoration: none;
    transition: transform 0.2s, background 0.3s;
}
.add-button:hover {
    background: rgba(34,197,94,0.95);
    transform: scale(1.05);
}

/* Table styles */
.table-wrapper {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px;
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

/* Subcategory badges */
.sub-badge {
    display: inline-block;
    background: rgba(255,255,255,0.2);
    padding: 0.25rem 0.5rem;
    border-radius: 0.75rem;
    font-size: 0.875rem;
    margin-right: 0.5rem;
    margin-bottom: 0.25rem;
}

/* Action buttons */
.action-button {
    padding: 0.25rem 0.5rem;
    border-radius: 0.75rem;
    color: #fff;
    font-weight: 500;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: transform 0.2s, background 0.3s;
}

.action-button:hover {
    transform: scale(1.05);
}

.manage-btn {
    background: rgba(59,130,246,0.8);
}

.manage-btn:hover {
    background: rgba(59,130,246,0.95);
}

.delete-btn {
    background: rgba(239,68,68,0.8);
}

.delete-btn:hover {
    background: rgba(239,68,68,0.95);
}

/* Responsive */
@media screen and (max-width: 768px) {
    table {
        min-width: 600px;
    }
}
</style>

<div class="glass-container">

    <h1>Categories</h1>

    <div style="text-align: right;">
        <a href="{{ route('admin.categories.create') }}" class="add-button">Add New Category</a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Subcategories</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->Category_name }}</td>
                    <td>
                        @foreach ($category->subcategories as $sub)
                            <span class="sub-badge">{{ $sub->SubCategory_name }}</span>
                        @endforeach
                    </td>
                    <td style="display:flex; gap:0.5rem; flex-wrap:wrap;">
                        <a href="{{ route('admin.categories.subcategories.index', ['categoryId' => $category->Category_ID]) }}" class="action-button manage-btn">Manage Subcategories</a>

                        <form action="{{ route('admin.categories.destroy', ['category' => $category->Category_ID]) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-button delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
