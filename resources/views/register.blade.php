<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up | Athletiq</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

  <div class="login-container">
    <div class="imgcontainer">
      <img src="{{ asset('images/logo.jpg') }}" alt="Athletiq Logo" class="avatar" style="width:100px; height:auto;">
    </div>
    </div>

    <h2>Create an Account</h2>

    @if ($errors->any())
      <div class="error-message">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
      @csrf

      <label for="email"><b>Email</b></label>
      <input type="email" name="email" placeholder="Enter Email" required>

      <label for="password"><b>Password</b></label>
      <input type="password" name="password" placeholder="Enter Password" required>

      <label for="password_confirmation"><b>Confirm Password</b></label>
      <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

      <button type="submit">Sign Up</button>

      <div class="signup-link">
        <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
      </div>

      <div class="cancel-container">
        <a href="{{ url('/') }}" class="cancelbtn">Cancel</a>
      </div>
    </form>
  </div>

</body>
</html>
