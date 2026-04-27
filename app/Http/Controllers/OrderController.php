<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private $Service;

    public function __construct(OrderService $orderService)
    {
        $this->Service = $orderService;

    }

    public function index()
    {
        $orders = Auth::user()->orders()->get();

        return view('orders.index', compact('orders'));
    }

    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $total = $this->Service->calculateTotal($cartItems);
        $addresses = Auth::user()->addresses()->get();

        return view('orders.checkout', compact(['cartItems', 'total', 'addresses']));
    }

    public function store(CreateOrderRequest $request)
    {
        $this->Service->createOrder(Auth::user(), $request->validated());

        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }
}
