<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        $query->when($request['search'], function ($q) use ($request) {
            $q->where('name', 'like', '%'.$request['search'].'%');
        });

        $products = $query->latest()->paginate(12);

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $category = $product->category;
        $relatedProducts = $category->products()->where('id', '!=', $product->id)->take(4)->get();

        return view('products.show', compact('category', 'product', 'relatedProducts'));
    }
}
