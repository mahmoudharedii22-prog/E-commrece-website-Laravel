<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;

class CartService
{
    public function addToCart(array $data, Product $product, $userId )
    {
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

    public function removeFromCart(Cart $cart): void
    {
        $cart->delete();
    }


    public function update( array $data, Cart $cart): void
    {
        $qty = $data['quantity'];

        if ($cart->product->stock < $qty) {
            throw new \Exception('Not enough stock for this product');
        }

        $cart->update([
            'quantity' => $qty,
        ]);
    }
}
