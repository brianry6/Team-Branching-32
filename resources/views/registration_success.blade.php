<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful | Athletiq</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <!-- Auto redirect after 5 seconds -->
    <meta http-equiv="refresh" content="5;url={{ route('login') }}">
    <style>
        /* Center content vertically and horizontally */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom right, #4f46e5, #8b5cf6, #ec4899);
            font-family: 'Inter', sans-serif;
            color: #fff;
            margin: 0;
            text-align: center;
        }

        .success-container {
            background: #fff;
            color: #1f2937;
            padding: 3rem 2rem;
            border-radius: 1rem;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            animation: fadeInUp 1s ease forwards;
        }

        .success-container h2 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: #4f46e5;
        }

        .success-container p {
            font-size: 1rem;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .success-container a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .success-container a:hover {
            color: #4338ca;
            text-decoration: underline;
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h2>🎉 Registration Successful!</h2>
        <p>Thank you for signing up. You will be redirected to the login page in 5 seconds.</p>
        <p>If not redirected, <a href="{{ route('login') }}">click here to login</a>.</p>
    </div>
</body>
</html>