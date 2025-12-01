<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
   public function placeOrder(Request $request)
{
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'delivery_address' => 'required|string|max:500',
    ]);

    $user = Auth::user();

    $cart = Cart::where('Customer_ID', $user->Customer_ID)->first();

    if (!$cart || $cart->products->isEmpty()) {
        return response()->json(['error' => 'Cart is empty'], 400);
    }

    // Start a database transaction


        // Create the order
        $order = Orders::create([
            'Order_date' => now(),
            'Delivery_address' => $request->delivery_address,
            'Order_status' => 'pending',
            'Cart_ID' => $cart->Cart_ID,
        ]);

        // Reduce product quantities
        foreach ($cart->products as $product) {
            $quantity = $product->pivot->Product_quantity;

            // Reduce stock
            $product->decrement('Quantity', $quantity); // assuming you have a Stock_quantity column
        }

        // Clear cart
        $cart->products()->detach();
 

    return response()->json(['success' => true, 'message' => 'Order placed successfully']);
}

}
