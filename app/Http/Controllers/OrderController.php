<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkOut()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $total = 0;
        foreach ($cartItems as $cartItem) {
            $total += $cartItem->product->price * $cartItem->quantity;
        }
        $addresses = Auth::user()->addresses()->get();

        return view('orders.checkout', compact(['cartItems', 'total', 'addresses']));
    }

    public function store(CreateOrderRequest $request)
    {
        $total = 0;
        $user = Auth::user();
        $data = $request->validated();

        $cartItems = $user->cart; // هاتها مرة واحدة

        DB::transaction(function () use ($user, $data, $cartItems, &$total) {

            foreach ($cartItems as $cartItem) {
                $total += $cartItem->product->price * $cartItem->quantity;
            }

            $order = $user->orders()->create([
                'address_id' => $data['address_id'],
                'total' => $total,
                'payment_method' => $data['payment_method'],
                'notes' => $data['notes'],
            ]);

            foreach ($cartItems as $cartItem) {

                // ربط المنتج بالأوردر
                $order->products()->attach($cartItem->product_id, [
                    'product_name' => $cartItem->product->name,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);

                // تقليل الاستوك
                $cartItem->product->decrement('stock', $cartItem->quantity);
            }

            // امسح الكارت بعد ما تخلص
            $user->cart()->delete();
        });

        return redirect()->route('home.index');
    }
}
