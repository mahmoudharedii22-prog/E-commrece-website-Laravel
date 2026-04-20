<x-layouts.app>

    <div class="container py-5">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-0">Products</h3>
                <p class="text-muted small mb-0">
                    Showing {{ $products->firstItem() }}–{{ $products->lastItem() }}
                    of {{ $products->total() }} results
                </p>
            </div>

            {{-- Search (if passed from controller) --}}
            @if (request('search'))
                <div class="alert alert-info py-2 px-3 mb-0 small">
                    Results for: <strong>{{ request('search') }}</strong>
                    <a href="{{ route('products.index') }}" class="ms-2 text-decoration-none">✕ Clear</a>
                </div>
            @endif
        </div>

        {{-- Product Grid --}}
        <div class="row g-4">
            @forelse ($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card product-card h-100 border-0">

                        {{-- Image Placeholder --}}
                        <div class="product-img d-flex align-items-center justify-content-center bg-light">
                            <i class="bi bi-image text-muted fs-1"></i>
                        </div>

                        <div class="card-body d-flex flex-column text-center px-3 pb-3">
                            <h6 class="card-title mb-1">{{ $product->name }}</h6>

                            <p class="text-primary fw-bold mb-3">
                                ${{ number_format($product->price, 2) }}
                            </p>

                            <a href="{{ route('products.show', ['category' => $product->category->slug, 'product' => $product]) }}"
                                class="btn btn-dark btn-sm w-100 mt-auto">
                                View Product
                            </a>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-box-seam fs-1 text-muted mb-3 d-block"></i>
                    <h5 class="text-muted">No products found</h5>
                    @if (request('search'))
                        <p class="text-muted small">Try a different search term.</p>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm mt-2">
                            Clear Search
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($products->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $products->links() }}
            </div>
        @endif

    </div>

</x-layouts.app>
    