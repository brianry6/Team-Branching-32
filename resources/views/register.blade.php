<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIGN UP | Athletiq</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<button class="theme-toggle">
    <i class='bx bx-moon'></i>
</button>
<body class="register-page">


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

    <h2>CREATE AN ACCOUNT</h2>

    @if ($errors->any())
      <div class="error-message">
        {{ $errors->first() }}
      </div>
    @endif

<form method="POST" action="{{ route('register.post') }}">
    @csrf
    <div class="name-wrapper">
    <input type="text" name="first-name" placeholder="First Name*" required>
    <input type="text" name="last-name" placeholder="Last Name*" required>
    </div>
    <input type="email" name="email" placeholder="Email Address*" required>

    <div class="password-wrapper">
        <input type="password" id="password" name="password" placeholder="Password" required>
        <i class='bx bx-hide toggle-password' data-target="password"></i>
    </div>

    <div class="password-wrapper">
        <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirm Password" required>
    </div>

    <button type="submit">Sign Up</button>

    <div class="signup-link">
        <p>Already have an account? 
            <a href="{{ route('login') }}">Sign in here</a>
        </p>
    </div>
</form>
  </div>

</body>
<script src="{{ asset('js/login.js') }}"></script>

</html>
