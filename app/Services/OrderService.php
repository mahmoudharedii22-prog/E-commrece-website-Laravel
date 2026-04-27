<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function calculateTotal($cartItems): float
    {
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->price * $item->quantity;
        }

        return $total;
    }

    public function createOrder(User $user, array $data): void
    {
        $products = $this->getProductsFromCart($data['cart_items']);

        $preparedData = $this->prepareOrderData($data['cart_items'], $products);

        DB::transaction(function () use ($user, $data, $preparedData) {

            $order = $user->orders()->create([
                'address_id' => $data['address_id'],
                'payment_method' => $data['payment_method'],
                'notes' => $data['notes'] ?? null,
                'total' => $preparedData['total'],
            ]);

            $order->items()->createMany($preparedData['items']);

            $this->clearUserCart($user->id);
        });
    }

    private function getProductsFromCart(array $cartItems)
    {
        return Product::whereIn(
            'id',
            array_column($cartItems, 'product_id')
        )->get()->keyBy('id');
    }

    private function prepareOrderData(array $cartItems, $products): array
    {
        return [
            'items' => $this->buildOrderItems($cartItems, $products),
            'total' => $this->calculateOrderTotal($cartItems, $products),
        ];
    }

    private function buildOrderItems(array $cartItems, $products): array
    {
        $items = [];

        foreach ($cartItems as $cartItem) {

            $product = $products[$cartItem['product_id']];

            $items[] = [
                'product_id' => $product->id,
                'quantity' => $cartItem['quantity'],
                'price' => $product->price,
                'product_name' => $product->name,
                'product_size' => $product->size ?? null,
            ];
        }

        return $items;
    }

    private function calculateOrderTotal(array $cartItems, $products): float
    {
        $total = 0;

        foreach ($cartItems as $cartItem) {

            $product = $products[$cartItem['product_id']];

            $total += $product->price * $cartItem['quantity'];
        }

        return $total;
    }

    private function clearUserCart(int $userId): void
    {
        Cart::where('user_id', $userId)->delete();
    }
}