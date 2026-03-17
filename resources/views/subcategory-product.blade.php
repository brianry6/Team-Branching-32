<style>
/* =========================================================
   SUBCATEGORY PRODUCTS PAGE (Unified with Global Styles)
   ========================================================= */
body {
  display:flex;
  align-items:center;
  justify-content:center;
  background: linear-gradient(to bottom right, #4f46e5, #8b5cf6, #ec4899);
}
body::before {
  content: '';
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('/images/hero-gym.jpg') center/cover no-repeat;
  opacity: 0.15;
  filter: blur(3px);
  z-index: -1;
}
.subcategory-products {
  padding: 4rem 1.5rem;
  background-color: #f9fafb;
}

/* Breadcrumb Navigation */
.breadcrumb {
  font-size: 0.875rem;
  color: #6b7280;
  margin-bottom: 1.5rem;
  text-align: center;
}
.breadcrumb a {
  color: #4f46e5;
  text-decoration: none;
  transition: color 0.3s;
}
.breadcrumb a:hover {
  color: #4338ca;
}
.breadcrumb span {
  color: #9ca3af;
  margin: 0 0.5rem;
}

/* Page Title */
.subcategory-products h2 {
  text-align: center;
  font-size: 2rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 2.5rem;
}

/* Product Grid Layout */
.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
  max-width: 1200px;
  margin: 0 auto;
}

/* Product Card */
.product-card {
  background: #fff;
  border-radius: 1rem;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  padding: 1.5rem;
  max-width:500px;
  text-align: center;
  transition: all 0.3s ease;
}
.product-card:hover {
  transform: translateY(-5px) scale(1.02);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

/* Product Image */
.product-card img {
  width: 100%;
  height: 12rem;
  object-fit: cover;
  border-radius: 0.75rem;
  margin-bottom: 1rem;
}

/* Product Name */
.product-card h3 {
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 0.25rem;
  font-size: 1rem;
}

/* Product Price */
.product-card p {
  font-size: 0.95rem;
  color: #4f46e5;
  font-weight: 600;
  margin-bottom: 1rem;
}

/* Button Wrapper */
.product-footer {
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Add to Cart Button */
.cart-btn {
  background: #4f46e5;
  color: #fff;
  border-radius: 0.375rem;
  border: none;
  padding: 0.5rem 0.75rem;
  cursor: pointer;
  font-weight: 600;
  font-size: 0.875rem;
  transition: background 0.3s;
}
.cart-btn:hover {
  background: #4338ca;
}

/* Login Link (Styled like Secondary Button) */
.button {
  display: inline-block;
  background: #eef2ff;
  color: #4f46e5;
  border-radius: 0.375rem;
  padding: 0.5rem 0.75rem;
  text-decoration: none;
  font-weight: 600;
  transition: background 0.3s, color 0.3s;
}
.button:hover {
  background: #4f46e5;
  color: #fff;
}

/* Product Search Form */
.product-search input,
.product-search select {
  padding:0.5rem 0.75rem;
  border-radius:0.375rem;
  border:1px solid #d1d5db;
  margin-right:0.5rem;
}
.product-search button {
  padding:0.5rem 1rem;
}

/* =========================================================
   RESPONSIVE BREAKPOINTS
   ========================================================= */
@media (max-width: 800px) {
  .breadcrumb {
    font-size: 0.8rem;
  }
  .subcategory-products h2 {
    font-size: 1.75rem;
  }
  .product-grid {
    grid-template-columns: 1fr;
  }
  .product-search input,
  .product-search select {
    margin-bottom:0.5rem;
    width: 100%;
  }
  .product-search button {
    width: 100%;
  }
}
</style>

<div class="subcategory-products">
  {{-- 🧭 Breadcrumb Navigation --}}
  <div class="breadcrumb">
    <a href="{{ url('/') }}">Home</a>
    <span>›</span>
    <a href="{{ route('category.subcategories', $subcategory->Category_ID) }}">
      {{ $subcategory->category->Category_name ?? 'Category' }}
    </a>
    <span>›</span>
    <span>{{ $subcategory->Subcategory_name }}</span>
  </div>

  <h2>Products in {{ $subcategory->SubCategory_name }}</h2>

  {{-- 🧵 Search / Filter (Only for Clothes Category) --}}
  @if($subcategory->category->Category_name == 'Clothes')
   <form method="GET" action="{{ route('subcategory.products.search', ['id' => $subcategory->SubCategory_ID]) }}" class="product-search" style="text-align:center; margin-bottom:2rem;">
      <select name="Size">
        <option value="">All Sizes</option>
        <option value="S" {{ request('Size')=='S' ? 'selected' : '' }}>S</option>
        <option value="M" {{ request('Size')=='M' ? 'selected' : '' }}>M</option>
        <option value="L" {{ request('Size')=='L' ? 'selected' : '' }}>L</option>
        <option value="XL" {{ request('Size')=='XL' ? 'selected' : '' }}>XL</option>
      </select>

      <select name="Color">
        <option value="">All Colors</option>
        <option value="Red" {{ request('Color')=='Red' ? 'selected' : '' }}>Red</option>
        <option value="Blue" {{ request('Color')=='Blue' ? 'selected' : '' }}>Blue</option>
        <option value="Green" {{ request('Color')=='Green' ? 'selected' : '' }}>Green</option>
        <option value="Black" {{ request('Color')=='Black' ? 'selected' : '' }}>Black</option>
        <option value="White" {{ request('Color')=='White' ? 'selected' : '' }}>White</option>
      </select>

     <select name="Brand">
      <option value="">All Brands</option>
      <option value="Nike" {{ request('brand')=='Nike' ? 'selected' : '' }}>Nike</option>
      <option value="Adidas" {{ request('brand')=='Adidas' ? 'selected' : '' }}>Adidas</option>
      <option value="Puma" {{ request('brand')=='Puma' ? 'selected' : '' }}>Puma</option>
      <option value="Reebok" {{ request('brand')=='Reebok' ? 'selected' : '' }}>Reebok</option>
      <option value="Under Armour" {{ request('brand')=='Under Armour' ? 'selected' : '' }}>Under Armour</option>
    </select>


      <button type="submit" class="cart-btn">Search</button>
    </form>
  @endif
  {{-- 🧵 Search / Filter --}}
@if($subcategory->SubCategory_ID == 5) {{-- Dumbbells & Weights --}}
  <form method="GET" action="{{ route('subcategory.products.search', ['id' => $subcategory->SubCategory_ID]) }}" class="product-search" style="text-align:center; margin-bottom:2rem;">
    
    <select name="Weight">
      <option value="">All Weights</option>
      <option value="2kg" {{ request('Weight')=='2kg' ? 'selected' : '' }}>2 kg</option>
      <option value="5kg" {{ request('Weight')=='5kg' ? 'selected' : '' }}>5 kg</option>
      <option value="10kg" {{ request('Weight')=='10kg' ? 'selected' : '' }}>10 kg</option>
      <option value="15kg" {{ request('Weight')=='15kg' ? 'selected' : '' }}>15 kg</option>
      <option value="20kg" {{ request('Weight')=='20kg' ? 'selected' : '' }}>20 kg</option>
      <option value="25kg" {{ request('Weight')=='25kg' ? 'selected' : '' }}>25 kg</option>
      <option value="30kg" {{ request('Weight')=='30kg' ? 'selected' : '' }}>30 kg</option>
    </select>

    <button type="submit" class="cart-btn">Search</button>
  </form>
@endif

  

  {{-- 🛒 Product Grid --}}
  <div class="product-grid">
    @foreach($products as $product)
             <div class="product-card">
        <img src="{{ asset('images/' . $product->Product_image) }}" alt="{{ $product->Product_name }}">
        <h3>{{ $product->Product_name }}</h3>
        <p>£{{ number_format($product->Price, 2) }}</p>

        <div class="product-footer">
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
</div>
