<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Athletiq</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    <div class="login-container">
        <div class="imgcontainer">
            <img src="{{ asset('images/logo.jpg') }}" alt="Athletiq Logo" class="avatar" style="width:100px; height:auto;">
        </div>

        <h2>Sign In</h2>

        {{-- ✅ Error Message Section --}}
        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <label for="email"><b>Email</b></label>
            <input type="email" name="email" placeholder="Enter Email" required>

            <label for="password"><b>Password</b></label>
            <input type="password" name="password" placeholder="Enter Password" required>

            <button type="submit">Login</button>

            <div class="login-links">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
                <a href="#">Forgot password?</a>
            </div>

            {{-- ✅ Sign-up Prompt --}}
            <div class="signup-link">
                <p>Don’t have an account? 
                    <a href="{{ route('register') }}">Sign up here</a>
                </p>
            </div>

            <div class="cancel-container">
                <a href="{{ url('/') }}" class="cancelbtn">Cancel</a>
            </div>
        </form>
    </div>

</body>
</html>
