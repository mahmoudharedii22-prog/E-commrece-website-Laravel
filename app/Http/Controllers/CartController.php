<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use AuthorizesRequests;

    protected $service;

    public function __construct(CartService $service)
    {
        $this->service = $service;
    }

    public function addToCart(AddToCartRequest $request, Product $product)
    {
        $this->service->addToCart($request->validated(), $product, Auth::id());

        return redirect()->route('products.show', $product)->with('success', 'Product added to cart');
    }

    public function index()
    {

        $cartItems = $this->service->getCartWithProducts(Auth::id());

        return view('cart.index', compact('cartItems'));
    }

    public function removeFromCart(Cart $cart)
    {
        $this->authorize('delete', $cart);
        $this->service->removeFromCart($cart);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart');
    }

    public function update(UpdateCartRequest $request, Cart $cart)
    {
        $this->authorize('update', $cart);
        $this->service->update($request->validated(), $cart);

        return redirect()->route('cart.index')->with('success', 'Product quantity updated');
    }
}
