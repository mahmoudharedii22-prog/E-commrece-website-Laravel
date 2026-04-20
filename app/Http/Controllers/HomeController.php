<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->take(12)
            ->get();

        $categories = Category::where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('products', 'categories'));
    }
}
