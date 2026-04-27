<x-layouts.app>

    <div class="container py-5">

        {{-- Header --}}
        <div class="text-center mb-5">
            <h3 class="fw-bold mb-1">Checkout</h3>
            <p class="text-muted small">Review your order and complete your purchase</p>
        </div>

        <div class="row g-4">

            {{-- LEFT: FORM --}}
            <div class="col-lg-7">

                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf

                    {{-- Addresses --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">

                            <h5 class="fw-semibold mb-3">
                                <i class="bi bi-geo-alt me-2 text-primary"></i>Shipping Address
                            </h5>

                            @forelse ($addresses as $address)
                                <label
                                    class="address-option border rounded-3 p-3 mb-2 w-100 d-block
                                {{ $address->is_default ? 'border-primary bg-light' : '' }}">

                                    <div class="form-check">

                                        <input class="form-check-input" type="radio" name="address_id"
                                            value="{{ $address->id }}" {{ $address->is_default ? 'checked' : '' }}>

                                        <div class="ms-2">

                                            <div class="d-flex justify-content-between">
                                                <strong>{{ $address->country }}, {{ $address->city }}</strong>

                                                @if ($address->is_default)
                                                    <span class="badge bg-success">Default</span>
                                                @endif
                                            </div>

                                            <small class="text-muted d-block">
                                                {{ $address->street }}
                                            </small>

                                            @if ($address->phone)
                                                <small class="text-muted">
                                                    {{ $address->phone }}
                                                </small>
                                            @endif

                                        </div>

                                    </div>

                                </label>

                            @empty
                                <div class="alert alert-warning">
                                    No addresses found. Please add one.
                                </div>
                            @endforelse

                        </div>
                    </div>

                    {{-- Payment --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">

                            <h5 class="fw-semibold mb-3">
                                <i class="bi bi-credit-card me-2 text-primary"></i>Payment
                            </h5>

                            <select name="payment_method" class="form-select mb-3">
                                <option value="cod">Cash on Delivery</option>
                                <option value="card">Credit Card</option>
                            </select>

                            <textarea name="notes" class="form-control" rows="3" placeholder="Optional notes..."></textarea>

                        </div>
                    </div>

                    {{-- CART DATA (IMPORTANT) --}}
                    @foreach ($cartItems as $item)
                        <input type="hidden" name="cart_items[{{ $loop->index }}][product_id]"
                            value="{{ $item->product->id }}">

                        <input type="hidden" name="cart_items[{{ $loop->index }}][quantity]"
                            value="{{ $item->quantity }}">
                    @endforeach

                    {{-- Submit --}}
                    <button class="btn btn-primary btn-lg w-100">
                        Place Order
                    </button>

                </form>

            </div>

            {{-- RIGHT: SUMMARY --}}
            <div class="col-lg-5">

                <div class="card border-0 shadow-sm sticky-top" style="top: 90px;">
                    <div class="card-body p-4">

                        <h5 class="fw-semibold mb-3">
                            <i class="bi bi-receipt me-2 text-primary"></i>Order Summary
                        </h5>

                        @foreach ($cartItems as $item)
                            <div class="d-flex justify-content-between mb-3">

                                <div>
                                    <div class="fw-semibold small">
                                        {{ $item->product->name }}
                                    </div>
                                    <small class="text-muted">
                                        Qty: {{ $item->quantity }}
                                    </small>
                                </div>

                                <div class="fw-semibold small">
                                    ${{ number_format($item->product->price * $item->quantity, 2) }}
                                </div>

                            </div>
                        @endforeach

                        <hr>

                        <div class="d-flex justify-content-between">
                            <span>Subtotal</span>
                            <strong>${{ number_format($total, 2) }}</strong>
                        </div>

                        <div class="d-flex justify-content-between text-success">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between fs-5 fw-bold">
                            <span>Total</span>
                            <span class="text-primary">
                                ${{ number_format($total, 2) }}
                            </span>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- Styles --}}
    @push('styles')
        <style>
            .address-option {
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .address-option:hover {
                border-color: #6366f1;
                background: #f8f9ff;
            }

            .address-option input:checked~div {
                font-weight: 600;
            }
        </style>
    @endpush

</x-layouts.app>
