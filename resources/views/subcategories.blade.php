<style>
/* =========================================================
   SUBCATEGORY PAGE
   ========================================================= */
body {
  margin: 0;
  font-family: sans-serif;
  background: linear-gradient(to bottom right, #4f46e5, #8b5cf6, #ec4899);
}

/* Background Image Layer */
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

/* Main Page Container */
.subcategory-page {
  padding: 4rem 1.5rem;
  background-color: transparent; /* make page background transparent */
  position: relative;
  z-index: 1;
}

/* Page Heading */
.subcategory-page h2 {
  text-align: center;
  font-size: 2rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 2.5rem;
}

/* Grid Layout */
.subcategory-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
  max-width: 1200px;
  margin: 0 auto;
  background-color: rgba(255, 255, 255, 0.3); /* semi-transparent white */
  padding: 1rem;
  border-radius: 1rem;
  backdrop-filter: blur(5px); /* optional, gives frosted glass effect */
}

/* Subcategory Card */
.subcategory-card {
  display: block;
  background: #fff;
  border-radius: 1rem;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  padding: 1.5rem;
  text-align: center;
  text-decoration: none;
  color: #1f2937;
  transition: all 0.3s ease;
}
.subcategory-card:hover {
  transform: translateY(-5px) scale(1.02);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

/* Subcategory Name */
.subcategory-card h3 {
  font-weight: 600;
  font-size: 1.1rem;
  color: #1f2937;
  margin-bottom: 0.5rem;
}

/* Subcategory Description */
.subcategory-card p {
  font-size: 0.9rem;
  color: #6b7280;
}

/* Home Button */
.home-btn {
  position: fixed;
  top: 1rem;
  left: 1rem;
  padding: 0.5rem 1rem;
  background-color: #2563eb;
  color: #fff;
  border-radius: 0.5rem;
  text-decoration: none;
  font-weight: 600;
  z-index: 1000;
}

/* Responsive */
@media (max-width: 800px) {
  .subcategory-page h2 {
    font-size: 1.75rem;
  }
  .subcategory-grid {
    grid-template-columns: 1fr;
  }
}
</style>

<div class="subcategory-page">
  <!-- Home Button -->
  <a href="{{ url('/') }}" class="home-btn">Home</a>

  <h2>Subcategories in {{ $category->Category_name }}</h2>
  
  <div class="subcategory-grid">
    @foreach($category->subcategories as $subcategory)
      <a href="{{ route('subcategory.products', $subcategory->SubCategory_ID) }}" class="subcategory-card">
        <h3>{{ $subcategory->SubCategory_name }}</h3>
        <p>{{ $subcategory->description ?? 'See products' }}</p>
      </a>
    @endforeach
  </div>
</div>
