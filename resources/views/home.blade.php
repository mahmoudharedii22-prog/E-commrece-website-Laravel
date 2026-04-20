<x-layouts.app>

    {{-- Hero --}}
    <section class="hero text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Shop Smart, Save More</h1>
            <p class="lead mb-4">Discover the best products at unbeatable prices</p>
            <a href="{{ route('products.index') }}" class="btn btn-light btn-lg px-5 shadow-sm">
                Shop Now
            </a>
        </div>
    </section>

    {{-- Categories --}}
    <section class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Categories</h3>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-primary btn-sm">View All</a>
        </div>

        <div class="row g-3">
            @forelse ($categories as $category)
                <div class="col-6 col-md-3">
                    <a href="{{ route('categories.show', $category->slug) }}" class="text-decoration-none">
                        <div class="card text-center p-3 shadow-sm border-0 category-card h-100">
                            <div class="card-body p-2">
                                <div class="category-icon mb-2">
                                    <i class="bi bi-grid fs-3 text-primary"></i>
                                </div>
                                <h6 class="mb-0 text-dark">{{ $category->name }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">No categories found.</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- Featured Products --}}
    <section class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Featured Products</h3>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">View All</a>
        </div>

        <div class="row g-4">
            @forelse ($products as $product)
                <div class="col-6 col-md-3">
                    <div class="card product-card h-100 border-0">
                        {{-- Product Image Placeholder --}}
                        <div class="product-img d-flex align-items-center justify-content-center bg-light">
                            <i class="bi bi-image text-muted fs-1"></i>
                        </div>

                        <div class="card-body text-center d-flex flex-column">
                            <h6 class="card-title mb-1">{{ $product->name }}</h6>
                            <p class="text-primary fw-bold mb-3">${{ number_format($product->price, 2) }}</p>

                            <a href="{{ route('products.show', $product) }}" class="btn btn-dark btn-sm w-100 mt-auto">
                                View Product
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">No featured products at the moment.</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- Flash Sale Banner --}}
    <section class="container mt-5 mb-5">
        <div class="flash-sale-banner p-5 rounded-4 text-center text-white">
            <h2 class="fw-bold mb-2">🔥 Flash Sale</h2>
            <p class="lead mb-4">Up to 50% off selected items — limited time only!</p>
            <a href="{{ route('products.index') }}" class="btn btn-light btn-lg px-5 fw-semibold">
                Shop the Sale
            </a>
        </div>
    </section>

</x-layouts.app>
