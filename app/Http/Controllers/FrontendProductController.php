<?php
namespace App\Http\Controllers;
use App\Models\Product;

class FrontendProductController extends Controller
{
    public function show($id)
    {
$product = Product::with('specifications')->findOrFail($id);        
return view('show', compact('product'));
    }
}