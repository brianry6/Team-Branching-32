<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    public function show($id) 
    {
        $product = Product::with('specifications')->findOrFail($id);        
        return view('show', compact('product'));
    }

    public function search(Request $request) 
    {
        $search = trim($request->input('search'));

        if (!$search) {
            $products = [];
        } else {
            $products = Product::where('Product_name', 'LIKE', "%{$search}%")->get();
        }

        // 4️⃣ Return results to view
        return view('search-results', compact('products', 'search'));
    }
}