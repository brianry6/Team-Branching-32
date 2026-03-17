<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* =========================================================
           Glassmorphic Admin Dashboard
        ========================================================= */
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #4f46e5, #8b5cf6, #ec4899);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
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

        .dashboard-container {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 2rem;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.25);
            backdrop-filter: blur(20px);
            padding: 3rem;
            width: 90%;
            max-width: 900px;
            color: #fff;
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dashboard-container h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .dashboard-grid a {
            display: block;
            padding: 2rem;
            border-radius: 1.5rem;
            font-weight: 600;
            font-size: 1.25rem;
            transition: transform 0.2s, background 0.3s;
            box-shadow: 0 4px 16px rgba(0,0,0,0.25);
        }

        .dashboard-grid a:hover {
            transform: scale(1.05);
        }

        .bg-blue {
            background: rgba(59, 130, 246, 0.7);
            border: 1px solid rgba(255,255,255,0.3);
        }
        .bg-blue:hover { background: rgba(59, 130, 246, 0.85); }

        .bg-green {
            background: rgba(34, 197, 94, 0.7);
            border: 1px solid rgba(255,255,255,0.3);
        }
        .bg-green:hover { background: rgba(34, 197, 94, 0.85); }

        .bg-yellow {
            background: rgba(234, 179, 8, 0.7);
            border: 1px solid rgba(255,255,255,0.3);
        }
        .bg-yellow:hover { background: rgba(234, 179, 8, 0.85); }

        @media screen and (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr !important;
                gap: 1.5rem !important;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Admin Dashboard</h1>

        <div class="grid grid-cols-3 gap-6 dashboard-grid">
            <a href="{{ route('admin.categories.index') }}" class="bg-blue text-white">
                Manage Categories
            </a>
            <a href="{{ route('admin.products.index') }}" class="bg-green text-white">
                Manage Products
            </a>
            <a href="{{ route('admin.orders.index') }}" class="bg-yellow text-white">
                Manage Orders
            </a>
        </div>
    </div>
</body>
</html>
