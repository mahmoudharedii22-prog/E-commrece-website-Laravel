<x-layouts.app>

    {{-- ═══════════════ HERO ═══════════════ --}}
    <section class="hero text-center">
        <div class="container">
            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb justify-content-center mb-0"
                    style="--bs-breadcrumb-divider-color: rgba(255,255,255,0.5); --bs-breadcrumb-item-active-color: #fff;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home.index') }}" class="text-white text-opacity-75 text-decoration-none small">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active small" aria-current="page">Categories</li>
                </ol>
            </nav>

            <h1 class="display-5 fw-bold mb-2">All Categories</h1>
            <p class="lead mb-0 text-white text-opacity-75">
                Discover what we have in store for you
            </p>
        </div>
    </section>

    {{-- ═══════════════ CATEGORIES GRID ═══════════════ --}}
    <section class="container my-5">

        {{-- Section meta row --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h2 class="h5 fw-semibold mb-0">Browse Categories</h2>
            <span class="badge bg-primary bg-opacity-10 text-primary fw-semibold px-3 py-2 rounded-pill small">
                {{ $categories->count() }} {{ Str::plural('Category', $categories->count()) }}
            </span>
        </div>

        @forelse ($categories as $category)
            {{-- Open row every 4 items (handled by Bootstrap grid, no manual chunking needed) --}}
            @if ($loop->first)
                <div class="row g-4">
            @endif

            {{-- ── Category Card ── --}}
            <div class="col-sm-6 col-md-4 col-lg-3">
                <a href="{{ route('categories.show', $category->slug) }}" class="text-decoration-none"
                    aria-label="Browse {{ $category->name }} category">

                    <div class="card category-card h-100 border-0 shadow-sm text-center p-4">

                        {{-- Icon Avatar (letter-based, no image dependency) --}}
                        <div class="category-icon mx-auto mb-3">
                            <span class="category-initial fw-bold">
                                {{ strtoupper(substr($category->name, 0, 1)) }}
                            </span>
                        </div>

                        {{-- Name --}}
                        <h5 class="fw-semibold mb-1 text-dark">
                            {{ $category->name }}
                        </h5>

                        {{-- Optional: product count if relation is loaded --}}
                        @if (isset($category->products_count))
                            <p class="text-muted small mb-3">
                                {{ $category->products_count }}
                                {{ Str::plural('product', $category->products_count) }}
                            </p>
                        @else
                            <p class="text-muted small mb-3">Shop now</p>
                        @endif

                        {{-- CTA Arrow --}}
                        <div class="category-arrow mt-auto">
                            <i class="bi bi-arrow-right-circle text-primary fs-5"></i>
                        </div>

                    </div>
                </a>
            </div>

            @if ($loop->last)
                </div>{{-- /.row --}}
            @endif

        @empty

            {{-- ── Empty State ── --}}
            <div class="row">
                <div class="col-12">
                    <div class="text-center py-5 my-3">
                        <div class="empty-state-icon mx-auto mb-4">
                            <i class="bi bi-grid-3x3-gap text-muted" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="fw-semibold text-dark mb-2">No Categories Yet</h4>
                        <p class="text-muted mb-4">
                            We are still adding categories. Check back soon!
                        </p>
                        <a href="{{ route('home.index') }}" class="btn btn-primary px-4">
                            <i class="bi bi-house me-2"></i>Back to Home
                        </a>
                    </div>
                </div>
            </div>
        @endforelse

    </section>

    @push('styles')
        <style>
            /* ── Category Icon Avatar ── */
            .category-icon {
                width: 64px;
                height: 64px;
                border-radius: 16px;
                background: linear-gradient(135deg, var(--brand-primary, #4f46e5), var(--brand-accent, #06b6d4));
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .category-initial {
                color: #fff;
                font-size: 1.5rem;
                line-height: 1;
            }

            /* ── Card Hover ── */
            .category-card {
                border-radius: 16px !important;
                transition: transform 0.25s ease, box-shadow 0.25s ease;
            }

            .category-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 12px 28px rgba(79, 70, 229, 0.12) !important;
            }

            /* Arrow micro-interaction */
            .category-arrow .bi {
                transition: transform 0.2s ease;
            }

            .category-card:hover .category-arrow .bi {
                transform: translateX(4px);
            }

            /* ── Empty State Icon Container ── */
            .empty-state-icon {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                background: #f1f5f9;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        </style>
    @endpush

</x-layouts.app>
