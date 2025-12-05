<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Athletiq</title>
    <style>
        /* General page styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
            height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #111;
        }

        p {
            font-size: 1rem;
            color: #555;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #f0f0f0;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        /* Grand total */
        .grand-total {
            font-size: 1.2rem;
            font-weight: 600;
            text-align: right;
            margin-top: 20px;
        }

        /* Buttons */
        .btn-primary {
            display: inline-block;
            background-color: #8b5cf6;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-primary:hover {
            background-color: #6c2173ff;
        }
        .bottom-buttons{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:30px;

        }
        .btn-primary[style] {
    background-color: #ef4444;
    color: #fff;
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 600;
}

.btn-primary[style]:hover {
    background-color: #b91c1c;
}

        /* Responsive table for small screens */
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                display: none;
            }

            td {
                padding: 10px;
                border: none;
                position: relative;
                padding-left: 50%;
            }

            td::before {
                position: absolute;
                top: 10px;
                left: 10px;
                width: 45%;
                font-weight: 600;
                white-space: nowrap;
            }

            td:nth-of-type(1)::before { content: "Product"; }
            td:nth-of-type(2)::before { content: "Quantity"; }
            td:nth-of-type(3)::before { content: "Unit Price (£)"; }
            td:nth-of-type(4)::before { content: "Total (£)"; }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Your Cart</h1>
        @php
$grandTotal = 0;
@endphp
        @if($products->isEmpty())
            <p>Your cart is empty.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price (£)</th>
                        <th>Total (£)</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach($products as $product)
                        @php
                            $total = $product->Price * $product->pivot->Product_quantity;
                            $grandTotal += $total;
                        @endphp
                        <tr>
    <td>{{ $product->Product_name }}</td>
    <td>{{ $product->pivot->Product_quantity }}</td>
    <td>£{{ number_format($product->Price, 2) }}</td>
    <td>£{{ number_format($total, 2) }}</td>
    <td>
        <form action="{{ route('cart.remove', $product->Product_ID) }}" method="POST">
            @csrf
            <button type="submit" class="btn-primary" style="background-color:#ef4444;">Remove</button>
        </form>
    </td>
</tr>
                    @endforeach
                </tbody>
            </table>

            <div class="grand-total">
                Total: £{{ number_format($grandTotal, 2) }}
            </div>
        @endif
        <div class="bottom-buttons">
            <a href="{{ url('/') }}" class="btn-primary">Continue Shopping</a>
           <!-- Checkout Button (on your cart page) -->
<a href="#" id="checkoutBtn" class="btn-primary">Proceed to Checkout</a>

<!-- Overlay Modal -->
<!-- Overlay Modal -->
<div id="checkoutModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="checkout-container">
      <!-- Billing & Payment Form -->
      <div class="checkout-form">
        <h2>Checkout</h2>
        <form action="/checkout" method="POST">
          @csrf
          <h3>Billing Address</h3>
          <label for="fname">Full Name</label>
          <input type="text" id="fname" name="firstname" placeholder="John M. Doe" required>

          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="john@example.com" required>

          <label for="adr">Address</label>
          <input type="text" id="adr" name="address" placeholder="542 W. 15th Street" required>

          <label for="city">City</label>
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

          <h3>Payment</h3>
          <label for="cname">Name on Card</label>
          <input type="text" id="cname" name="cardname" placeholder="John More Doe" required>

          <label for="ccnum">Credit card number</label>
          <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>

          <div class="row">
            <div class="col-50">
              <label for="expmonth">Exp Month</label>
              <input type="text" id="expmonth" name="expmonth" placeholder="September" required>
            </div>
            <div class="col-50">
              <label for="expyear">Exp Year</label>
              <input type="text" id="expyear" name="expyear" placeholder="2025" required>
            </div>
          </div>

          <div class="row">
            <div class="col-50">
              <label for="cvv">CVV</label>
              <input type="text" id="cvv" name="cvv" placeholder="352" required>
            </div>
            <div class="col-50"></div>
          </div>

          <label>
            <input type="checkbox" id="sameAsBilling" checked name="sameadr">
            Shipping address same as billing
          </label>

          <!-- Shipping Address (hidden by default) -->
          <div id="shippingAddress" style="display:none; margin-top: 15px;">
            <h3>Shipping Address</h3>
          
            <label for="s_adr">Address</label>
            <input type="text" id="s_adr" name="s_address" placeholder="542 W. 15th Street">

            <label for="s_city">City</label>
            <input type="text" id="s_city" name="s_city" placeholder="New York">

            <div class="row">
              <div class="col-50">
                <label for="s_state">State</label>
                <input type="text" id="s_state" name="s_state" placeholder="NY">
              </div>
              <div class="col-50">
                <label for="s_zip">Zip</label>
                <input type="text" id="s_zip" name="s_zip" placeholder="10001">
              </div>
            </div>
          </div>

         <button type="button" id="place-order-btn" class="cart-btn">Place Order</button>


        </form>
      </div>

      <!-- Cart Summary -->
      <div class="checkout-summary">
        <h3>Your Cart</h3>
        <p>Total items: <b>{{ $products->count() }}</b></p>
        <div class="summary-products">
          @foreach($products as $product)
            <div class="summary-product">
              <span>{{ $product->Product_name }}</span>
              <span>£{{ number_format($product->Price, 2) }}</span>
            </div>
          @endforeach
        </div>
        <hr>
        <p class="grand-total">Grand Total: £{{ number_format($grandTotal,2) }}</p>
      </div>
    </div>
  </div>
</div>


<style>
.modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0; top: 0;
  width: 100%; height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.6);
}

.modal-content {
  background-color: #fff;
  margin: 50px auto;
  padding: 30px;
  border-radius: 12px;
  width: 90%;
  max-width: 1100px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover {
  color: black;
}

.checkout-container {
  display: flex;
  gap: 30px;
  flex-wrap: wrap;
}

.checkout-form {
  flex: 2;
  min-width: 300px;
}

.checkout-summary {
  flex: 1;
  min-width: 250px;
  background: #f9f9f9;
  padding: 20px;
  border-radius: 12px;
  height: fit-content;
}

.checkout-summary h3 {
  margin-bottom: 15px;
}

.summary-products {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.summary-product {
  display: flex;
  justify-content: space-between;
}

.grand-total {
  font-weight: 700;
  margin-top: 15px;
}

input[type=text], input[type=email] {
  width: 100%;
  padding: 10px;
  margin: 6px 0 16px 0;
  border: 1px solid #ccc;
  border-radius: 6px;
}

.row {
  display: flex;
  gap: 10px;
}

.col-50 {
  flex: 1;
}

.checkout-btn {
  width: 100%;
  padding: 12px;
  background-color: #8b5cf6;
  border-radius: 8px;
  color: #fff;
  font-weight: 600;
  margin-top: 10px;
  cursor: pointer;
}

.checkout-btn:hover {
  background-color: #6c2173ff;
}

@media (max-width: 900px) {
  .checkout-container {
    flex-direction: column;
  }
}
</style>

<script>
const modal = document.getElementById('checkoutModal');
const btn = document.getElementById('checkoutBtn');
const span = document.querySelector('.close');
const sameAdrCheckbox = document.getElementById('sameAsBilling');
const shippingAddress = document.getElementById('shippingAddress');

btn.onclick = function() {
  modal.style.display = 'block';
}

span.onclick = function() {
  modal.style.display = 'none';
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = 'none';
  }
}

// Toggle shipping address fields
document.getElementById('place-order-btn').addEventListener('click', async function() {
    // Collect values from the form inputs
    const customerName = document.getElementById('fname').value.trim();
    const deliveryAddress = document.getElementById('adr').value.trim();

    if (!customerName || !deliveryAddress) {
        alert("Please enter both name and delivery address.");
        return;
    }

    try {
        const response = await fetch("{{ route('orders.place') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ 
                customer_name: customerName, 
                delivery_address: deliveryAddress 
            })
        });

        if (!response.ok) throw new Error("Failed to place order");

        // Build invoice from Blade data
        let invoice = "Order Placed Successfully!\n\n";
        invoice += "Name: " + customerName + "\n";
        invoice += "Address: " + deliveryAddress + "\n\n";
        invoice += "Products:\n";

        @foreach($products as $product)
        invoice += "- {{ $product->Product_name }} ({{ $product->pivot->Product_quantity }}) x £{{ number_format($product->Price, 2) }}\n";
        @endforeach

        let total = @json($products->sum(fn($p) => $p->Price * $p->pivot->Product_quantity));
        invoice += "\nTotal: £" + total.toFixed(2);

        alert(invoice);

        location.reload(); // Refresh page to clear cart
    } catch (err) {
        alert("Error placing order: " + err.message);
    }
});
</script>

        </div>
    </div>

</body>
</html>
