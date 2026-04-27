<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category'); // ✅ eager loading

        $query->when($request->search, function ($q, $search) {
            $q->where('name', 'like', '%' . $search . '%');
        });

        $products = $query->latest()->paginate(12);

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('category'); // ✅ eager load product relation

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}