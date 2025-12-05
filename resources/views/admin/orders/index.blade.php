@extends('layouts.admin')

@section('content')
<style>
/* =========================================================
   Glassmorphic Orders Page
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
    max-width: 1000px;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 2rem;
    box-shadow: 0 8px 32px rgba(31,38,135,0.25);
    backdrop-filter: blur(20px);
    padding: 2rem;
    color: #fff;
    animation: fadeIn 0.8s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
}

/* Table wrapper for horizontal scroll */
.table-wrapper {
    overflow-x: auto;
}

/* Table styling */
table {
    width: 100%;
    border-collapse: collapse;
    min-width: 700px;
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

/* Dropdown and buttons */
select {
    padding: 0.25rem 0.5rem;
    border-radius: 0.5rem;
    border: 1px solid rgba(255,255,255,0.3);
    background: rgba(255,255,255,0.1);
    color: #fff;
    font-size: 0.875rem;
    outline: none;
    transition: all 0.3s;
}

select:focus {
    border-color: rgba(147,197,253,0.8);
    background: rgba(255,255,255,0.2);
}

button {
    background: rgba(59,130,246,0.8);
    border: none;
    border-radius: 0.5rem;
    color: #fff;
    font-weight: 500;
    padding: 0.25rem 0.75rem;
    cursor: pointer;
    transition: transform 0.2s, background 0.3s;
}

button:hover {
    background: rgba(59,130,246,0.95);
    transform: scale(1.05);
}

/* Responsive */
@media screen and (max-width: 768px) {
    .glass-container {
        padding: 1.5rem;
    }

    table {
        min-width: 100%;
    }
}
</style>

<div class="glass-container">
    <h1>Orders</h1>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
              
                
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->Order_ID }}</td>
                    
                 
                
                    <td>{{ $order->Order_status }}</td>
                    <td>
                        <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="Order_status">
                                <option value="pending" @if($order->Order_status=='pending') selected @endif>Pending</option>
                                <option value="processing" @if($order->Order_status=='processing') selected @endif>Processing</option>
                                <option value="completed" @if($order->Order_status=='completed') selected @endif>Completed</option>
                            </select>
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($orders->isEmpty())
                <tr>
                    <td colspan="6" style="text-align:center; color:rgba(255,255,255,0.7); padding:1rem;">
                        No orders found.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
