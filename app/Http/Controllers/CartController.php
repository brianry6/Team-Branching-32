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

        $productId = $request->product_id;
        $customer = Auth::user();

        if (!$customer) {
            // Guest cart stored in session
            $cart = session()->get('cart', []);
            $cart[$productId] = ($cart[$productId] ?? 0) + 1;
            session()->put('cart', $cart);

            return back()->with('success', 'Product added to cart!');
        }

        // Authenticated user
        $cart = $customer->cart ?? Cart::create(['Customer_ID' => $customer->Customer_ID]);

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

    // Show cart page
    public function showCart()
    {
        $customer = Auth::user();

        if (!$customer) {
            // Guest
            $sessionCart = session()->get('cart', []);
            $products = Product::whereIn('Product_ID', array_keys($sessionCart))->get();

            // Remove missing products
            $validIds = $products->pluck('Product_ID')->toArray();
            $sessionCart = array_intersect_key($sessionCart, array_flip($validIds));
            session()->put('cart', $sessionCart);

            return view('cart_show', compact('products', 'sessionCart'));
        }

        // Authenticated
        $cart = $customer->cart;
        $products = $cart ? $cart->products()->withPivot('Product_quantity')->get() : collect();

        return view('cart_show', compact('products'));
    }

    // Remove or decrement product
    public function remove($productId)
    {
        $customer = Auth::user();

        if (!$customer) {
            // Guest
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                if ($cart[$productId] > 1) {
                    $cart[$productId]--;
                } else {
                    unset($cart[$productId]);
                }
                session()->put('cart', $cart);
            }
            return back()->with('success', 'Cart updated!');
        }

        // Authenticated
        $cart = $customer->cart;
        if ($cart) {
            $existing = $cart->products()->wherePivot('Product_ID', $productId)->first();
            if ($existing) {
                $qty = $existing->pivot->Product_quantity;
                if ($qty > 1) {
                    $cart->products()->updateExistingPivot($productId, ['Product_quantity' => $qty - 1]);
                } else {
                    $cart->products()->detach($productId);
                }
            }
        }

        return back()->with('success', 'Cart updated!');
    }
}