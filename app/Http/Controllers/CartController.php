<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add product to cart
 public function add(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:Product,Product_ID',
    ]);

    $customer = Auth::user();

    // Get or create cart for the customer
    $cart = $customer->cart ?? Cart::create(['Customer_ID' => $customer->Customer_ID]);

    $productId = $request->product_id;
    echo $productId;
    // Check if the product is already in the cart
    $existing = $cart->products()->wherePivot('Product_ID', $productId)->first();

    if ($existing) {
        $cart->products()->updateExistingPivot($productId, [
            'Product_quantity' => $existing->pivot->Product_quantity + 1
        ]);
    } else {
        $cart->products()->attach($productId, ['Product_quantity' => 1]);
    }

    return back()->with('success', 'Product added to cart!');
}
 public function showCart()
    {
        $customer = Auth::user();
        $cart = $customer->cart;

        if (!$cart) {
            $products = collect(); // empty collection
        } else {
            $products = $cart->products()->withPivot('Product_quantity')->get();
        }

        return view('cart_show', compact('products'));
    }
    public function remove($productId)
{
    $customer = Auth::user();
    $cart = $customer->cart;

    if ($cart) {
        // Get the existing product in the cart
        $existing = $cart->products()->wherePivot('Product_ID', $productId)->first();


        if ($existing) {
            $currentQuantity = $existing->pivot->Product_quantity;

            if ($currentQuantity > 1) {
                // Decrement quantity by 1
                $cart->products()->updateExistingPivot($productId, [
                    'Product_quantity' => $currentQuantity - 1
                ]);
            } else {
                // Remove the product entirely if quantity is 1
                $cart->products()->detach($productId);
            }
        }
    }

    return redirect()->back()->with('success', 'Product updated in cart!');
}



}
