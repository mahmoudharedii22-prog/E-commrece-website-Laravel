<x-layouts.app>
    <!-- Hero -->
    <section class="hero text-center">
        <div class="container">
            <h1 class="display-5 fw-bold">
                {{ $category->name }}
            </h1>

            <p class="lead">
                {{ $category->description ?? 'Browse all products in this category' }}
            </p>
        </div>
    </section>

    <!-- Products -->
    <section class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Products</h3>

            <span class="text-muted">
                {{ $products->total() }} items
            </span>
        </div>

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

        <!-- Pagination -->
        <div class="mt-4">
            {{ $products->links() }}
        </div>

    </section>
</x-layouts.app>
