<style>
/* =========================================================
   ABOUT US PAGE — Glassmorphic Design (matches Contact page)
   ========================================================= */
body {
  margin: 0;
  font-family: 'Inter', sans-serif;
  background: linear-gradient(to bottom right, #4f46e5, #8b5cf6, #ec4899);
  position: relative;
  min-height: 100vh;
  overflow-x: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Blurred background image layer */
body::before {
  content: '';
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('/images/hero-gym.jpg') center/cover no-repeat;
  opacity: 0.25;
  filter: blur(6px);
  z-index: -1;
}

/* Floating glass wrapper */
.about-page {
  width: 100%;
  max-width: 1100px;
  background: rgba(255, 255, 255, 0.12);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 1.5rem;
  box-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
  backdrop-filter: blur(20px);
  color: #fff;
  padding: 3rem;
  box-sizing: border-box;
  margin: 2rem;
}

/* Header Section */
.about-header {
  text-align: center;
  margin-bottom: 3rem;
}
.about-header h1 {
  font-size: 2.5rem;
  font-weight: 800;
  margin-bottom: 1rem;
}
.about-header p {
  font-size: 1.125rem;
  color: rgba(255, 255, 255, 0.85);
  max-width: 700px;
  margin: 0 auto;
  line-height: 1.7;
}

/* Content Sections */
.about-section {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 1rem;
  padding: 2rem;
  margin-bottom: 2rem;
  backdrop-filter: blur(25px);
  box-shadow: 0 4px 30px rgba(0,0,0,0.1);
  transition: all 0.3s ease;
}
.about-section:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 40px rgba(0,0,0,0.25);
}
.about-section h2 {
  font-size: 1.5rem;
  font-weight: 700;
  color: #fff;
  margin-bottom: 1rem;
}
.about-section p {
  font-size: 1rem;
  color: rgba(255, 255, 255, 0.9);
  line-height: 1.75;
}

/* Mission & Vision Grid */
.about-values {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
  margin-top: 2rem;
}
.value-card {
  background: rgba(255, 255, 255, 0.12);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 1rem;
  padding: 1.5rem;
  text-align: center;
  backdrop-filter: blur(20px);
  transition: all 0.3s ease;
}
.value-card:hover {
  transform: translateY(-5px);
  background: rgba(255, 255, 255, 0.2);
}
.value-card h3 {
  color: #c7d2fe;
  font-size: 1.25rem;
  font-weight: 700;
  margin-bottom: 0.75rem;
}
.value-card p {
  font-size: 0.95rem;
  color: rgba(255, 255, 255, 0.85);
  line-height: 1.6;
}

/* Call to Action */
.about-cta {
  text-align: center;
  margin-top: 3rem;
}
.about-cta a {
  display: inline-block;
  background: #4f46e5;
  color: #fff;
  padding: 0.75rem 1.5rem;
  border-radius: 0.5rem;
  font-weight: 600;
  text-decoration: none;
  transition: background 0.3s, transform 0.2s;
}
.about-cta a:hover {
  background: #4338ca;
  transform: scale(1.03);
}

/* Responsive */
@media (max-width: 900px) {
  body {
    align-items: flex-start;
  }
  .about-page {
    margin: 2rem 1rem;
    padding: 2rem;
  }
  .about-header h1 {
    font-size: 2rem;
  }
}
</style>

<body>
<div class="about-page">
  <div class="about-header">
    <h1>About Athletiq</h1>
    <p>
      Athletiq is your go-to destination for high-quality fitness gear, performance wear,
      and essential training accessories. Fitness isn’t just a routine — it’s a lifestyle.
    </p>
  </div>

  <div class="about-section">
    <h2>Our Story</h2>
    <p>
      Founded by athletes and fitness enthusiasts, Athletiq was born from a simple idea:
      to make premium sportswear accessible to everyone. We started with a small lineup of gym
      essentials and have since grown into a trusted name across the global fitness community.
    </p>
    <p>
      Every product we design is tested for comfort, durability, and performance — because we
      know what it means to push limits and strive for more.
    </p>
  </div>

  <div class="about-section">
    <h2>What We Stand For</h2>
    <div class="about-values">
      <div class="value-card">
        <h3>Performance</h3>
        <p>Gear engineered to help you dominate every workout and exceed your goals.</p>
      </div>
      <div class="value-card">
        <h3>Innovation</h3>
        <p>We constantly experiment with advanced fabrics and functional designs to keep you ahead.</p>
      </div>
      <div class="value-card">
        <h3>Community</h3>
        <p>From first-timers to pros, we’re here to support every fitness journey.</p>
      </div>
    </div>
  </div>

  <div class="about-section">
    <h2>Our Mission</h2>
    <p>
      Our mission is to inspire confidence through movement. Athletiq blends style with
      performance, offering gear that empowers you to move freely and perform at your best —
      because true strength comes from persistence and passion.
    </p>
  </div>

  <div class="about-cta">
    <a href="{{ url('/') }}">Explore Our Products</a>
  </div>
</div>
</body>
