<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-blue-600 text-white p-4 shadow">
        <h1 class="text-2xl font-bold">Admin Panel</h1>
    </header>

    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
