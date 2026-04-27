<x-layouts.app>

    <div class="container py-5">

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Product Detail --}}
        <div class="row g-5 align-items-start">

            {{-- Image --}}
            <div class="col-md-5">
                <div class="product-detail-img d-flex align-items-center justify-content-center bg-light rounded-4">
                    <i class="bi bi-image text-muted" style="font-size: 5rem;"></i>
                </div>
            </div>

            {{-- Details --}}
            <div class="col-md-7">

                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb small">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home.index') }}" class="text-decoration-none">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('categories.show', $product->category->slug) }}"
                                class="text-decoration-none">
                                {{ $product->category->name }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>

                <h2 class="fw-bold mb-1">{{ $product->name }}</h2>

                <p class="text-muted small mb-3">
                    Category:
                    <a href="{{ route('categories.show', $product->category->slug) }}" class="text-decoration-none">
                        {{ $product->category->name }}
                    </a>
                </p>

                <h3 class="text-primary fw-bold mb-3">${{ number_format($product->price, 2) }}</h3>

                <p class="text-secondary mb-4">{{ $product->description }}</p>

                {{-- Stock Badge --}}
                <div class="mb-4">
                    @if ($product->stock > 10)
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">
                            <i class="bi bi-check-circle me-1"></i>In Stock ({{ $product->stock }} available)
                        </span>
                    @elseif ($product->stock > 0)
                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2">
                            <i class="bi bi-exclamation-circle me-1"></i>Low Stock — only {{ $product->stock }} left
                        </span>
                    @else
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">
                            <i class="bi bi-x-circle me-1"></i>Out of Stock
                        </span>
                    @endif
                </div>

                {{-- Add to Cart Form --}}
                <form method="POST" action="{{ route('cart.store', $product) }}">
                    @csrf

                    <div class="d-flex align-items-end gap-3 mb-3">
                        <div>
                            <label for="quantity" class="form-label fw-semibold mb-1">Quantity</label>
                            <input type="number" id="quantity" name="quantity" class="form-control"
                                style="width: 90px;" value="1" min="1" max="{{ $product->stock }}"
                                {{ $product->stock === 0 ? 'disabled' : '' }}>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark btn-lg w-100"
                        {{ $product->stock === 0 ? 'disabled' : '' }}>
                        <i class="bi bi-cart-plus me-2"></i>Add to Cart
                    </button>

                </form>

            </div>

        </div>

        {{-- Related Products --}}
        <section class="mt-5 pt-4 border-top">

            <h4 class="mb-4">Related Products</h4>

            <div class="row g-4">
                @forelse ($relatedProducts as $related)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card product-card h-100 border-0">

                            <div class="product-img d-flex align-items-center justify-content-center bg-light">
                                <i class="bi bi-image text-muted fs-1"></i>
                            </div>

                            <div class="card-body d-flex flex-column text-center px-3 pb-3">
                                <h6 class="card-title mb-1">{{ $related->name }}</h6>
                                <p class="text-primary fw-bold mb-3">${{ number_format($related->price, 2) }}</p>
                                <a href="{{ route('products.show', $related) }}"
                                    class="btn btn-dark btn-sm w-100 mt-auto">
                                    View Product
                                </a>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <i class="bi bi-box-seam fs-1 text-muted d-block mb-2"></i>
                        <p class="text-muted mb-0">No related products found.</p>
                    </div>
                @endforelse
            </div>

        </section>

    </div>

    @push('styles')
        <style>
            .product-detail-img {
                height: 420px;
                border-radius: 16px;
            }
        </style>
    @endpush

</x-layouts.app>
