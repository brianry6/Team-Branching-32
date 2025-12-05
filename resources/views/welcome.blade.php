<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Athletiq</title>
  <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

  <!-- NAVBAR -->
  <header class="header">
    <div class="container header-container">
      <a href="/" class="logo">Athletiq</a>
      <button id="menu-btn" class="hamburger">☰</button>

      <nav id="menu" class="menu">
        <a href="#shop" class="nav-link">Shop</a>
        <a href="#categories" class="nav-link">Categories</a>
        <a href="/about" class="nav-link">About</a>
        <a href="/contact" class="nav-link">Contact</a>

        @auth
          <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="nav-link">Logout</button>
          </form>
          <a href="/cart" class="cart-btn"><i class="fa fa-shopping-cart"></i>  Cart ({{ $cartCount }})</a>
        @else
          <a href="{{ route('login') }}" class="nav-link">Sign In</a>
          <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
        @endauth
      </nav>
    </div>
  </header>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-container">
      <div class="hero-text">
        <h1>Gear Up. Train Harder. Be Unstoppable.</h1>
        <p>Discover elite gym gear, apparel, and nutrition designed to power your every move.</p>
        <div class="hero-buttons">
          <a href="#shop" class="btn-primary">Shop Now</a>
          <a href="#categories" class="btn-secondary">Browse Categories</a>
        </div>
      </div>
      <div class="hero-image">
        <img src="/images/hero-gym.jpg" alt="Hero">
      </div>
    </div>
  </section>

  <!-- FEATURED PRODUCTS -->
  <section id="shop" class="products">
    <h2>🔥 Featured Products</h2>
    <div class="product-grid">
      @foreach ($featuredProducts as $product)
        <div class="product-card">
          <img src="{{ asset('images/' . $product->Product_image) }}" alt="{{ $product->Product_name }}">
          <h3>{{ $product->Product_name }}</h3>
          <p class="product-desc">Premium quality to enhance your workouts.</p>

          @if($product->specifications->count() > 0)
            <ul class="product-specs">
              @foreach($product->specifications as $spec)
                @if(strtolower($spec->Spec_name) === 'others')
                  <li>{{ $spec->pivot->Spec_value }}</li>
                @else
                  <li><strong>{{ $spec->Spec_name }}:</strong> {{ $spec->pivot->Spec_value }}</li>
                @endif
              @endforeach
            </ul>
          @else
            <p class="no-specs">Specifications not available</p>
          @endif

          <div class="product-footer">
            <span>£{{ number_format($product->Price, 2) }}</span>
            @auth
              <form method="POST" action="{{ route('cart.add') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->Product_ID }}">
                <button type="submit" class="cart-btn">Add</button>
              </form>
            @else
              <a href="{{ route('login') }}" class="button">Login to Buy</a>
            @endauth
          </div>
        </div>
      @endforeach
    </div>
  </section>

  <!-- CATEGORIES -->
  <section id="categories" class="categories">
    <h2>🏋️ Shop by Category</h2>
    <div class="category-grid">
      @foreach ($categories as $category)
        <a href="{{ route('category.subcategories', $category->Category_ID) }}" class="category-card">
          @if($category->image)
            <img src="{{ asset('images/categories/' . $category->image) }}" alt="{{ $category->name }}">
          @else
            <div class="category-icon">💪</div>
          @endif
          <h3>{{ $category->Category_name }}</h3>
          <p>{{ $category->description ?? 'Explore top picks' }}</p>
        </a>
      @endforeach
    </div>
  </section>

  <!-- CHATBOT -->
 
    <button id="chat-toggle">💬 Chat</button>
    <div id="chat-box">
      <div id="chat-header">Chat with Athletiq</div>
      <div id="chat-messages"></div>
      <input type="text" id="chat-input" placeholder="Type a message..." />
    </div>


  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-grid">
      <div>
        <h3>Athletiq</h3>
        <p>Your ultimate destination for fitness gear and style.</p>
      </div>
      <div>
        <h4>Support</h4>
        <ul>
          <li><a href="#faq">FAQ</a></li>
          <li><a href="#shipping">Shipping</a></li>
          <li><a href="#returns">Returns</a></li>
        </ul>
      </div>
      <div>
        <h4>Follow Us</h4>
        <div class="social">
          <a href="#" class="fa fa-instagram"></a>
          <a href="#" class="fa fa-facebook"></a>
          <a href="#" class="fa fa-twitter"></a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">© 2025 Athletiq. All rights reserved.</div>
  </footer>
<script>
  const menuBtn = document.getElementById('menu-btn');
  const menu = document.getElementById('menu');
  menuBtn.addEventListener('click', () => {
    menu.classList.toggle('show');
  });

  const themeToggleBtn = document.getElementById('theme-toggle');
  const savedTheme = localStorage.getItem('theme') || 'light';
  if (themeToggleBtn) {
    document.body.classList.toggle('dark-mode', savedTheme === 'dark');
    themeToggleBtn.textContent = savedTheme === 'dark' ? 'Light mode' : 'Dark mode';
    themeToggleBtn.addEventListener('click', () => {
      const isDark = document.body.classList.toggle('dark-mode');
      themeToggleBtn.textContent = isDark ? 'Light mode' : 'Dark mode';
      localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });
  }

  const toggleBtn = document.getElementById('chat-toggle');
  const chatBox = document.getElementById('chat-box');
  const chatInput = document.getElementById('chat-input');
  const chatMessages = document.getElementById('chat-messages');

  toggleBtn.addEventListener('click', () => {
    chatBox.classList.toggle('active');
  });

 
  const predefinedReplies = [
    {
      keywords: ["hello", "hi", "hey"],
      answer: "Hi there! 👋 Welcome to Athletiq. How can I help you with your fitness gear today?"
    },
    {
      keywords: ["shipping", "delivery"],
      answer: "We currently ship across the UK. Standard delivery usually takes 3–5 working days."
    },
    {
      keywords: ["return", "refund"],
      answer: "Most items can be returned within 30 days in unused condition for a refund or exchange."
    },
    {
      keywords: ["size", "sizing"],
      answer: "If you are between sizes, we usually suggest sizing up for extra comfort."
    },
    {
      keywords: ["payment", "pay", "card"],
      answer: "We accept major debit/credit cards and common online payment methods at checkout."
    },
    {
      keywords: ["support", "help", "contact"],
      answer: "You can reach support via the Contact page or by using the details in the footer."
    },
    {
      keywords: ["protein", "supplement"],
      answer: "Our supplements are designed to support muscle growth and recovery. Always follow the label directions."
    }
  ];

 function getPredefinedReply(text) {
  const lower = text.toLowerCase();

  for (const item of predefinedReplies) {
    for (const kw of item.keywords) {
      // Build a regex that matches the whole word, case‑insensitive
      const pattern = new RegExp("\\b" + kw.toLowerCase() + "\\b", "i");
      if (pattern.test(lower)) {
        return item.answer;
      }
    }
  }

  return "I’m not sure I understand yet, but I can help with shipping, returns, sizing, payments, or our products. 😊";
}


  chatInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter' && chatInput.value.trim() !== '') {
      const userText = chatInput.value;

      // Show user message
      const userMsg = document.createElement('div');
      userMsg.textContent = "You: " + userText;
      userMsg.style.fontWeight = '600';
      chatMessages.appendChild(userMsg);

      // Get bot reply from predefined rules
      const reply = getPredefinedReply(userText);
      const botMsg = document.createElement('div');
      botMsg.textContent = "Bot: " + reply;
      chatMessages.appendChild(botMsg);

      chatMessages.scrollTop = chatMessages.scrollHeight;
      chatInput.value = '';
    }
  });
</script>

</body>
</html>
