<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ATHLETIQ')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    @yield('styles') <!-- Add this line -->
 

</head>   

<button class="theme-toggle">
    <i class='bx bx-moon'></i>
</button>


<body>
    <nav class="navbar">
    <div class="overlay"></div>

    <div class="nav-links">
        <div class="mobile-menu-header">
        <span><img class="mobile-logo-dark" src="{{ asset('images/logo-dark.svg') }}" alt=""></span>
    </div>
      <div class="mobile-menu-header-dark">
        <span><img class="mobile-logo" src="{{ asset('images/logo.svg') }}" alt=""></span>
    </div>
   @if(isset($categories))
        <ul>
            @foreach ($categories as $category)
                <li>
                    <a href="#">
                        {{ $category->Category_name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif


             <li class="mobile-actions">
        <div class="menu-buttons">
        <a href="{{ route('login') }}" class="menu-btn">
  <span class="bx bx-user btn-text"></span>Login</a>
  <a href="/cart" class="menu-btn">
  <span class="bx bx-cart btn-text"></span>Cart
</a></div> 
            </li>
    </div>
    <a href="/" class="logo"><img src="{{ asset('images/logo.svg') }}" alt=""></a>
    <a href="/" class="logo-dark"><img src="{{ asset('images/logo-dark.svg') }}" alt=""></a>

    <i class='bx bx-menu menu-icon'></i>
     <div class="nav-icons">
        <div class="search-wrapper">
            <form action="{{ route('search') }}" method="GET">
         <input type="text" name="search" class="search-input" placeholder="Search...">
            <i class='bx bx-search search-icon'></i>
</form>
        </div>
        <a href="/cart" class=cart-a>
        <i class='bx bx-cart'></i>
</a>
        <a href="{{ route('login') }}" class="nav-icon-link">
    <i class='bx bx-user'></i>
</a>
    </div>
</nav>

    @yield('content')  <!-- This is where each page’s content goes -->
    <footer class="site-footer">
    <div class="footer-container">
        <div class="footer-about">
            <img class="logo" src="{{ asset('images/logo.svg') }}">
            <img class="logo-dark" src="{{ asset('images/logo-dark.svg') }}">
            <p>Fitness for everyone.</p>
        </div>

        <div class="footer-links">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="#men">Men</a></li>
                <li><a href="#women">Women</a></li>
                <li><a href="#accessories">Accessories</a></li>
                <li><a href="#content">Featured</a></li>
                <li><a href="#collections">Collections</a></li>
                <li><a href="/about">About</a></li>
            </ul>
        </div>

        <div class="footer-social">
            <h4>Follow Us</h4>
            <a href="#"><i class='bx bxl-instagram'></i></a>
            <a href="#"><i class='bx bxl-facebook'></i></a>
            <a href="#"><i class='bx bxl-twitter'></i></a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2026 ATHLETIQ. All rights reserved.</p>
    </div>
</footer>

</body>
<script src="{{ asset('js/script.js') }}"></script>
</html>