<?php
namespace App\Http\Controllers\Admin;
use App\Models\ProductSpecification;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Specification;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('subcategory.category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $subcategories = Subcategory::with('category')->get();

        $specifications = Specification::all();
        return view('admin.products.create', compact('subcategories', 'specifications'));
    }

   public function store(Request $request)
    {
        $validated = $request->validate([
            'Product_name' => 'required|string|max:255',
            'Price' => 'required|numeric|min:0',
            'Quantity' => 'required|integer|min:1',
            'SubCategory_ID' => 'required|exists:Subcategory,SubCategory_ID',
            'Product_image' => 'nullable|image|max:2048',
        ]);

        // Store image with original filename
        if ($request->hasFile('Product_image')) {
            $file = $request->file('Product_image');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('products', $filename, 'public'); // store in 'products' folder
            $validated['Product_image'] = $filename;
        }

        // Create the product
        $product = Product::create($validated);

        // Save dynamic specifications
        if ($request->has('specifications')) {
            foreach ($request->specifications as $specName => $specValue) {
                // Find Spec_ID from Specifications table
                $spec = Specification::where('Spec_name', $specName)->first();

                if ($spec) {
                    ProductSpecification::create([
                        'Product_ID' => $product->Product_ID, // Use Product_ID if that's your PK
                        'Spec_ID' => $spec->Spec_ID,
                        'Spec_value' => $specValue
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product added successfully!');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted.');
    }

    public function destroyAll()
    {
        Product::truncate();
        return back()->with('success', 'All products removed.');
    }
}
