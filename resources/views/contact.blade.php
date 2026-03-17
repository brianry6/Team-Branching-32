<style>
body {
  margin-top: 20;
  font-family: 'Inter', sans-serif;
  background: linear-gradient(to bottom right, #4f46e5, #8b5cf6, #ec4899);
  position: relative;
  height: 100%;
  overflow-x: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Blurred background image */
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
.contact-page {
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
}

/* Header inside the card */
.contact-header {
  text-align: center;
  margin-bottom: 3rem;
}
.contact-header h1 {
  font-size: 2.5rem;
  font-weight: 800;
  margin-bottom: 1rem;
}
.contact-header p {
  font-size: 1.125rem;
  color: rgba(255, 255, 255, 0.85);
  max-width: 700px;
  margin: 0 auto;
  line-height: 1.7;
}

/* Contact info + form grid */
.contact-container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2.5rem;
}

/* Glassy inner sections */
.contact-info, .contact-form {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 1rem;
  padding: 2rem;
  backdrop-filter: blur(25px);
  box-shadow: 0 4px 30px rgba(0,0,0,0.1);
  transition: all 0.3s ease;
}
.contact-info:hover, .contact-form:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 40px rgba(0,0,0,0.25);
}

/* Info side */
.contact-info h2 {
  color: #fff;
  margin-bottom: 1rem;
}
.contact-info p, .contact-info li {
  color: rgba(255, 255, 255, 0.9);
  line-height: 1.6;
}
.contact-info a {
  color: #e0e7ff;
  text-decoration: none;
  transition: color 0.3s;
}
.contact-info a:hover {
  color: #c7d2fe;
}

/* Form side */
.contact-form h2 {
  color: #fff;
  margin-bottom: 1rem;
}
.contact-form form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}
.contact-form label {
  color: rgba(255, 255, 255, 0.9);
  font-weight: 500;
}
.contact-form input,
.contact-form textarea {
  background: rgba(255, 255, 255, 0.15);
  color: #fff;
  border: 1px solid rgba(255, 255, 255, 0.25);
  border-radius: 0.5rem;
  padding: 0.75rem 1rem;
  font-size: 0.95rem;
  width: 100%;
}
.contact-form input::placeholder,
.contact-form textarea::placeholder {
  color: rgba(255, 255, 255, 0.6);
}
.contact-form input:focus,
.contact-form textarea:focus {
  border-color: #c7d2fe;
  outline: none;
  box-shadow: 0 0 0 3px rgba(199, 210, 254, 0.2);
}

/* Button */
.contact-form button {
  background: #4f46e5;
  color: #fff;
  padding: 0.75rem 1.5rem;
  border-radius: 0.5rem;
  border: none;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.3s, transform 0.2s;
}
.contact-form button:hover {
  background: #4338ca;
  transform: scale(1.03);
}

/* Responsive layout */
@media (max-width: 900px) {
  body {
    align-items: flex-start;
  }
  .contact-page {
    margin: 2rem;
    padding: 2rem;
  }
  .contact-container {
    grid-template-columns: 1fr;
  }
  .contact-header h1 {
    font-size: 2rem;
  }
}

</style>
<body>
<div class="contact-page">
  <div class="contact-header">
    <h1>Contact Athletiq</h1>
    <p>
      We’d love to hear from you. Whether you have a question about your order, need help finding the perfect gear, 
      or just want to share feedback — our team is here to help.
    </p>
  </div>

  <div class="contact-container">
    <!-- Contact Info -->
    <div class="contact-info">
      <h2>Get in Touch</h2>
      <p>You can reach us anytime through the following channels:</p>
      <ul>
        <li><strong>Email:</strong> <a href="mailto:support@athletiq.com">support@athletiq.com</a></li>
        <li><strong>Phone:</strong> <a href="tel:+441234567890">+44 1234 567 890</a></li>
        <li><strong>Address:</strong> 123 Fitness Lane, London, UK</li>
        <li><strong>Hours:</strong> Mon–Fri, 9AM – 6PM</li>
      </ul>
      <p>
        Follow us on social media for fitness tips, product drops, and exclusive offers!
      </p>
      <ul>
        <li><a href="#">Instagram</a> | <a href="#">Facebook</a> | <a href="#">Twitter</a></li>
      </ul>
    </div>

    <!-- Contact Form -->
    <div class="contact-form">
      <h2>Send a Message</h2>
      <form method="POST" action="{{ route('contact.submit') }}">
        @csrf
        <div>
          <label for="name">Name</label>
          <input type="text" id="name" name="name" placeholder="Your full name" required>
        </div>
        <div>
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="you@example.com" required>
        </div>
        <div>
          <label for="message">Message</label>
          <textarea id="message" name="message" rows="5" placeholder="How can we help?" required></textarea>
        </div>
        <button type="submit">Send Message</button>
      </form>
    </div>
  </div>
</div>
</body>