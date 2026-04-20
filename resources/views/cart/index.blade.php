<x-layouts.app>

    <div class="container py-5">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0">🛒 My Cart</h3>
            <a href="/" class="btn btn-outline-secondary btn-sm">
                Continue Shopping
            </a>
        </div>

        @if ($cartItems->count() > 0)

            <div class="card border-0 shadow-sm rounded-3">

                <div class="card-body p-0">

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">

                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Product</th>
                                    <th>Price</th>
                                    <th style="width: 180px;">Quantity</th>
                                    <th>Total</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @php $grandTotal = 0; @endphp

                                @foreach ($cartItems as $item)
                                    @php
                                        $total = $item->price * $item->quantity;
                                        $grandTotal += $total;
                                    @endphp

                                    <tr>

                                        <!-- Product -->
                                        <td class="ps-4 fw-semibold">
                                            {{ $item->product->name }}
                                        </td>

                                        <!-- Price -->
                                        <td class="text-muted">
                                            ${{ number_format($item->price, 2) }}
                                        </td>

                                        <!-- Quantity -->
                                        <td>
                                            <form method="POST" action="{{ route('cart.update', $item) }}"
                                                class="d-flex align-items-center gap-2">
                                                @csrf
                                                @method('PUT')

                                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                    min="1" class="form-control form-control-sm text-center"
                                                    style="max-width: 70px;">

                                                <button class="btn btn-outline-dark btn-sm">
                                                    Update
                                                </button>
                                            </form>
                                        </td>

                                        <!-- Total -->
                                        <td class="fw-semibold">
                                            ${{ number_format($total, 2) }}
                                        </td>

                                        <!-- Remove -->
                                        <td class="text-end pe-4">
                                            <form method="POST"
                                                action="{{ route('cart.destroy', ['cart' => $item]) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-outline-danger btn-sm">
                                                    ✕
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>

                </div>

            </div>

            <!-- Summary Section -->
            <div class="card border-0 shadow-sm rounded-3 mt-4">
                <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <h5 class="mb-0">
                        Grand Total:
                        <span class="text-primary fw-bold">
                            ${{ number_format($grandTotal, 2) }}
                        </span>
                    </h5>

                    <a href="{{ route('orders.checkout') }}" class="btn btn-success btn-lg px-4">
                        Proceed to Checkout
                    </a>

                </div>
            </div>
        @else
            <div class="alert alert-info text-center py-4">
                <h5 class="mb-2">Your cart is empty 🛒</h5>
                <a href="/" class="btn btn-primary btn-sm mt-2">
                    Start Shopping
                </a>
            </div>
        @endif

    </div>

</x-layouts.app>
