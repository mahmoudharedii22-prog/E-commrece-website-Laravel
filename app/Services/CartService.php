<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function addToCart(array $data, Product $product)
    {
        $userId = Auth::id();
        $qty = $data['quantity'];
        $cartItem = Cart::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();
        if ($cartItem) {
            $cartItem->quantity += $qty;
            $cartItem->save();

            return;
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => $qty,
                'price' => $product->price,
            ]);
        }
    }

    public function getCartWithProducts($userId)
    {
        return Cart::with('product')->where('user_id', $userId)->get();
    }

    public function removeFromCart($userId, Cart $cart): void
    {
        $cart->delete();
    }

    public function update(array $data, Cart $cart)
    {

        $qty = $data['quantity'];

        $cart->quantity = $qty;
        $cart->save();
    }
}
