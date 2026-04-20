<x-layouts.app>

    <div class="container py-5">

        {{-- Page Header --}}
        <div class="text-center mb-5">
            <h3 class="fw-bold mb-1">Checkout</h3>
            <p class="text-muted small">Review your order and complete your purchase</p>
        </div>

        <div class="row g-4 align-items-start">

            {{-- ── Left: Form ── --}}
            <div class="col-lg-7">

                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf

                    {{-- Shipping Address --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">

                            <h5 class="fw-semibold mb-3">
                                <i class="bi bi-geo-alt me-2 text-primary"></i>Shipping Address
                            </h5>

                            @forelse ($addresses as $address)
                                <div
                                    class="address-option border rounded-3 p-3 mb-2
                                    {{ $address->is_default ? 'border-primary' : '' }}">

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="address_id"
                                            id="address{{ $address->id }}" value="{{ $address->id }}"
                                            {{ $address->is_default ? 'checked' : '' }}>

                                        <label class="form-check-label w-100" for="address{{ $address->id }}">

                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <strong>{{ $address->country }}, {{ $address->city }}</strong>
                                                @if ($address->is_default)
                                                    <span
                                                        class="badge bg-success-subtle text-success border border-success-subtle">
                                                        Default
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="text-muted small">
                                                <i class="bi bi-signpost me-1"></i>{{ $address->street }}
                                            </div>

                                            @if ($address->phone)
                                                <div class="text-muted small mt-1">
                                                    <i class="bi bi-telephone me-1"></i>{{ $address->phone }}
                                                </div>
                                            @endif

                                        </label>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <i class="bi bi-geo text-muted fs-2 d-block mb-2"></i>
                                    <p class="text-muted mb-2">No addresses found.</p>
                                    <a href="{{ route('profile.show') }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-plus me-1"></i>Add Address
                                    </a>
                                </div>
                            @endforelse

                        </div>
                    </div>

                    {{-- Payment & Notes --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">

                            <h5 class="fw-semibold mb-3">
                                <i class="bi bi-credit-card me-2 text-primary"></i>Payment & Notes
                            </h5>

                            <div class="mb-3">
                                <label for="payment_method" class="form-label fw-semibold small">Payment Method</label>
                                <select id="payment_method" name="payment_method" class="form-select">
                                    <option value="cod">💵 Cash on Delivery</option>
                                    <option value="card">💳 Credit Card</option>
                                </select>
                            </div>

                            <div class="mb-1">
                                <label for="notes" class="form-label fw-semibold small">
                                    Additional Notes <span class="text-muted fw-normal">(optional)</span>
                                </label>
                                <textarea id="notes" name="notes" class="form-control" rows="3"
                                    placeholder="E.g. Leave at the door, call before delivery…"></textarea>
                            </div>

                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary btn-lg w-100"
                        {{ $addresses->isEmpty() ? 'disabled' : '' }}>
                        <i class="bi bi-lock me-2"></i>Place Order
                    </button>

                </form>

            </div>

            {{-- ── Right: Order Summary ── --}}
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm sticky-lg-top" style="top: 100px; z-index: 1;">
                    <div class="card-body p-4">

                        <h5 class="fw-semibold mb-3">
                            <i class="bi bi-receipt me-2 text-primary"></i>Order Summary
                        </h5>

                        <ul class="list-unstyled mb-0">
                            @foreach ($cartItems as $item)
                                <li class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <span class="fw-semibold small">{{ $item->product->name }}</span>
                                        <div class="text-muted small">Qty: {{ $item->quantity }}</div>
                                    </div>
                                    <span class="fw-semibold small">
                                        ${{ number_format($item->product->price * $item->quantity, 2) }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>

                        <hr class="my-3">

                        <div class="d-flex justify-content-between align-items-center mb-2 text-muted small">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2 text-muted small">
                            <span>Shipping</span>
                            <span class="text-success">Free</span>
                        </div>

                        <hr class="my-3">

                        <div class="d-flex justify-content-between align-items-center fw-bold fs-5">
                            <span>Total</span>
                            <span class="text-primary">${{ number_format($total, 2) }}</span>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

    @push('styles')
        <style>
            .address-option {
                transition: border-color 0.2s ease, background-color 0.2s ease;
                cursor: pointer;
            }

            .address-option:has(input:checked) {
                border-color: #4f46e5 !important;
                background-color: #f5f3ff;
            }

            .address-option:hover {
                border-color: #a5b4fc;
                background-color: #fafafa;
            }
        </style>
    @endpush

</x-layouts.app>
