<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Product;

class CategoryController extends Controller
{
    public function showSubcategories($id)
{
    // Assuming you have a Category model with a `subcategories` relation
    $category = \App\Models\Category::with('subcategories')->findOrFail($id);

    return view('subcategories', [
        'category' => $category,
        'subcategories' => $category->subcategories,
    ]);
}
    public function showProducts($id)
    {
        $subcategory = Subcategory::with('category', 'products')->findOrFail($id);

        return view('subcategory-product', [
            'subcategory' => $subcategory,
            'products' => $subcategory->products,
        ]);
    }

    public function searchProducts(Request $request, $id)
{
    $subcategory = Subcategory::with('category')->findOrFail($id);

    $products = Product::where('SubCategory_ID', $id);

    // Filter clothes specifications if category is Clothes
    if ($subcategory->category->Category_name == 'Clothes') {

        if ($request->filled('Size')) {
            $products->whereHas('specifications', function ($q) use ($request) {
                $q->where('Spec_name', 'Size')
                  ->where('product_specifications.Spec_value', $request->Size);
            });
        }

        if ($request->filled('Color')) {
            $products->whereHas('specifications', function ($q) use ($request) {
                $q->where('Spec_name', 'Color')
                  ->where('product_specifications.Spec_value', $request->Color);
            });
        }

        if ($request->filled('Brand')) {
            $products->whereHas('specifications', function ($q) use ($request) {
                $q->where('Spec_name', 'Brand')
                  ->where('product_specifications.Spec_value', 'like', '%' . $request->Brand . '%');
            });
        }
    }

    // Filter weight if subcategory is Dumbbells & Weights
    if ($subcategory->SubCategory_ID == 5 && $request->filled('Weight')) {
        $products->whereHas('specifications', function ($q) use ($request) {
    $weight = strtolower(str_replace(' ', '', $request->Weight));
    $q->where('Spec_name', 'Weight')
      ->whereRaw("REPLACE(LOWER(product_specifications.Spec_value), ' ', '') LIKE ?", ["%{$weight}%"]);
});
    }

    $products = $products->get();

    return view('subcategory-product', [
        'subcategory' => $subcategory,
        'products' => $products,
    ]);
}

}
