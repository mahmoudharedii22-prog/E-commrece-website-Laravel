<x-layouts.app>
    <div class="container py-5">

        <h2 class="fw-bold mb-4">My Orders</h2>
        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @forelse ($orders as $order)

            <div class="card mb-4 border-0 shadow-sm rounded-4 overflow-hidden">

                {{-- HEADER --}}
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">

                    <div>
                        <h6 class="mb-1 fw-bold">
                            Order #{{ $order->id }}
                        </h6>
                        <small class="text-muted">
                            Placed on {{ $order->created_at->format('d M Y') }}
                        </small>
                    </div>

                    {{-- STATUS --}}
                    <span
                        class="badge px-3 py-2 rounded-pill
                        @if ($order->status == 'pending') bg-warning text-dark
                        @elseif($order->status == 'shipped') bg-info text-dark
                        @elseif($order->status == 'completed') bg-success
                        @else bg-danger @endif
                    ">
                        {{ ucfirst($order->status) }}
                    </span>

                </div>

                {{-- BODY --}}
                <div class="card-body">

                    @foreach ($order->items as $item)
                        <div class="d-flex justify-content-between align-items-start py-2 border-bottom">

                            <div>
                                <h6 class="mb-1 fw-semibold">
                                    {{ $item->product_name }}
                                </h6>

                                <small class="text-muted">
                                    Qty: <span class="fw-semibold">{{ $item->quantity }}</span>
                                    @if ($item->product_size)
                                        | Size: <span class="fw-semibold">{{ $item->product_size }}</span>
                                    @endif
                                </small>
                            </div>

                            <div class="text-end">
                                <div class="fw-bold text-dark">
                                    ${{ number_format($item->price * $item->quantity, 2) }}
                                </div>
                                <small class="text-muted">
                                    ${{ number_format($item->price, 2) }} each
                                </small>
                            </div>

                        </div>
                    @endforeach

                </div>

                {{-- FOOTER --}}
                <div class="card-footer bg-light d-flex justify-content-between align-items-center">

                    <div class="text-muted small">
                        Payment: <span class="fw-semibold text-dark">{{ ucfirst($order->payment_method) }}</span>
                    </div>

                    <div class="text-end">
                        <span class="text-muted me-2">Total:</span>
                        <span class="fw-bold fs-5 text-primary">
                            ${{ number_format($order->total, 2) }}
                        </span>
                    </div>

                </div>

            </div>

        @empty

            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-bag-x fs-1 text-muted"></i>
                </div>
                <h5 class="fw-bold">No orders yet</h5>
                <p class="text-muted">Start shopping to see your orders here</p>

                <a href="{{ route('products.index') }}" class="btn btn-primary px-4">
                    Start Shopping
                </a>
            </div>

        @endforelse

    </div>
</x-layouts.app>
