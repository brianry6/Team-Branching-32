<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | ATHLETIQ</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<button class="theme-toggle">
    <i class='bx bx-moon'></i>
</button>


<body class="login-page">

        <div class="cancel-container">
                <a href="{{ url('/') }}" class="cancelbtn">
                    <i class='bx bx-arrow-back' ></i>
                </a>
            </div>

    <div class="login-container">
        <div class="imgcontainer">
            <img src="{{ asset('images/logo.svg') }}" alt="Athletiq Logo" class="avatar-dark">
            <img src="{{ asset('images/logo-dark.svg') }}" alt="Athletiq Logo" class="avatar-light">


        </div>

        <h2>LOG IN</h2>

        {{-- ✅ Error Message Section --}}
        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

           <input type="email" id="email" name="email" placeholder="Enter Email" required>
<div class="password-wrapper">
    <input 
        type="password" 
        id="password"
        name="password" 
        placeholder="Enter Password" 
        required
        autocomplete="current-password"
    >
    <i class='bx bx-hide toggle-password' data-target="password"></i>
</div>

            <button type="submit">Login</button>

            <div class="login-links">
               <label class="remember-me">
                <input type="checkbox" name="remember" />
                <span class="checkmark"></span>
                Remember Me
                </label>
                <a href="#">Forgot password?</a>
            </div>

            {{-- ✅ Sign-up Prompt --}}
            <div class="signup-link">
                <p>Don’t have an account? 
                    <a href="{{ route('register') }}">Sign up here</a>
                </p>
            </div>
        </form>
    </div>

</body>

<script src="{{ asset('js/login.js') }}"></script>

</html>
