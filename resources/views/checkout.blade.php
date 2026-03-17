<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      font-family: Arial, sans-serif;
    }
    .row {
      display: flex;
      flex-wrap: wrap;
      margin: 0 -16px;
    }
    .col-75 {
      flex: 75%;
      padding: 0 16px;
    }
    .col-50 {
      flex: 50%;
      padding: 0 16px;
    }
    .col-25 {
      flex: 25%;
      padding: 0 16px;
    }
    .container {
      background-color: #f2f2f2;
      padding: 20px;
      border-radius: 3px;
    }
    input[type=text] {
      width: 100%;
      margin-bottom: 15px;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }
    input[type=checkbox] {
      cursor: pointer;
      width: 18px;
      height: 18px;
      margin-right: 8px;
    }
    label {
      display: block;
      margin-bottom: 8px;
    }
    .checkbox-label {
      display: flex;
      align-items: center;
      margin-top: 15px;
      margin-bottom: 15px;
      cursor: pointer;
    }
    .icon-container {
      margin-bottom: 20px;
      padding: 7px 0;
      font-size: 24px;
    }
    .btn {
      background-color: #04AA6D;
      color: white;
      padding: 12px;
      margin-top: 10px;
      border: none;
      width: 100%;
      border-radius: 3px;
      cursor: pointer;
      font-size: 17px;
    }
    .btn:hover {
      background-color: #45a049;
    }
    span.price {
      float: right;
      color: grey;
    }
    h2 {
      margin-left: 16px;
    }
    p {
      margin-left: 16px;
    }
    @media (max-width: 800px) {
      .row {
        flex-direction: column;
      }
      .col-25 {
        margin-bottom: 20px;
      }
    }
  </style>
</head>
<body>

<h2>Checkout Form</h2>
<p>Fill in your billing details and optionally a different shipping address.</p>

<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="/checkout" method="POST">
        @csrf

        <div class="row">
          <!-- Billing -->
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe" required>

            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com" required>

            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street" required>

            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York" required>

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY" required>
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001" required>
              </div>
            </div>

            <!-- Checkbox + Shipping block -->
            <div class="checkbox-label">
              <input type="checkbox" id="sameadr" name="sameadr" checked="checked" onchange="toggleShipping()">
              <label for="sameadr" style="display: inline; margin-bottom: 0; margin-left: 5px;">Shipping address same as billing</label>
            </div>

            <div id="shipping-address" style="display:none; margin-top:15px;">
              <h3>Shipping Address</h3>
              <label for="sadr"><i class="fa fa-address-card-o"></i> Address</label>
              <input type="text" id="sadr" name="shipping_address" placeholder="542 W. 15th Street">

              <label for="scity"><i class="fa fa-institution"></i> City</label>
              <input type="text" id="scity" name="shipping_city" placeholder="New York">

              <div class="row">
                <div class="col-50">
                  <label for="sstate">State</label>
                  <input type="text" id="sstate" name="shipping_state" placeholder="NY">
                </div>
                <div class="col-50">
                  <label for="szip">Zip</label>
                  <input type="text" id="szip" name="shipping_zip" placeholder="10001">
                </div>
              </div>
            </div>
          </div>

          <!-- Payment -->
          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>

            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe" required>

            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>

            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September" required>

            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2028" required>
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352" required>
              </div>
            </div>
          </div>
        </div>

        <button type="submit" class="btn">Place Order</button>
      </form>
    </div>
  </div>

  <!-- Cart summary -->
  <div class="col-25">
    <div class="container">
      <h4>Cart
        <span class="price" style="color:black">
          <i class="fa fa-shopping-cart"></i>
          <b>{{ $cartCount ?? 0 }}</b>
        </span>
      </h4>
      @forelse($cartItems ?? [] as $item)
        <p><a href="#">{{ $item->name }}</a> <span class="price">£{{ $item->price }}</span></p>
      @empty
        <p>Your cart is empty</p>
      @endforelse
      <hr>
      <p>Total <span class="price" style="color:black"><b>£{{ $cartTotal ?? 0 }}</b></span></p>
    </div>
  </div>
</div>

<script>
  function toggleShipping() {
    const checkbox = document.getElementById('sameadr');
    const shippingDiv = document.getElementById('shipping-address');
    
    if (checkbox.checked) {
      shippingDiv.style.display = 'none';  // Hide when checked
    } else {
      shippingDiv.style.display = 'block'; // Show when unchecked
    }
  }

  // Initialize on page load
  document.addEventListener('DOMContentLoaded', function() {
    toggleShipping();
  });
</script>

</body>
</html>
