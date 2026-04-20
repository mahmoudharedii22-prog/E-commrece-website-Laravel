<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'MyShop' }}</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* ── Navbar ── */
        .navbar {
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
        }

        /* ── Hero ── */
        .hero {
            background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
            color: white;
            padding: 100px 0;
            border-radius: 0 0 40px 40px;
        }

        /* ── Category Card ── */
        .category-card {
            border-radius: 12px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .category-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
        }

        /* ── Product Card ── */
        .product-card {
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.1);
        }

        .product-img {
            height: 160px;
        }

        /* ── Flash Sale Banner ── */
        .flash-sale-banner {
            background: linear-gradient(135deg, #f97316, #ef4444);
        }

        /* ── Buttons ── */
        .btn-primary {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #4338ca;
            border-color: #4338ca;
        }

        .btn-outline-primary {
            color: #4f46e5;
            border-color: #4f46e5;
        }

        .btn-outline-primary:hover {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }

        /* ── Footer ── */
        footer {
            margin-top: 80px;
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- ═══════════════ NAVBAR ═══════════════ --}}
    <nav class="navbar navbar-expand-lg bg-white sticky-top">
        <div class="container">

            {{-- Logo --}}
            <a class="navbar-brand fw-bold text-primary fs-4" href="{{ route('home.index') }}">
                <i class="bi bi-bag-heart-fill me-1"></i>MyShop
            </a>

            {{-- Mobile Toggle --}}
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Nav Content --}}
            <div class="collapse navbar-collapse" id="mainNav">

                {{-- Search Bar --}}
                <form class="d-flex mx-auto w-50" method="GET" action="{{ route('products.index') }}" role="search">
                    <div class="input-group">
                        <input name="search" type="search" class="form-control" placeholder="Search products..."
                            aria-label="Search products" value="{{ request('search') }}">
                        <button class="btn btn-primary px-3" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                {{-- Right-side Nav --}}
                <ul class="navbar-nav ms-auto align-items-center gap-1">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home.index') ? 'active fw-semibold' : '' }}"
                            href="{{ route('home.index') }}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('categories.*') ? 'active fw-semibold' : '' }}"
                            href="{{ route('categories.index') }}">Categories</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active fw-semibold' : '' }}"
                            href="{{ route('products.index') }}">Products</a>
                    </li>

                    {{-- Cart --}}
                    <li class="nav-item ms-1">
                        <a class="nav-link position-relative px-2" href="{{ route('cart.index') }}" aria-label="Cart">
                            <i class="bi bi-cart3 fs-5"></i>
                            @if ($cartCount > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $cartCount > 99 ? '99+' : $cartCount }}
                                    <span class="visually-hidden">items in cart</span>
                                </span>
                            @endif
                        </a>
                    </li>

                    {{-- Auth --}}
                    @auth
                        <li class="nav-item dropdown ms-1">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="#"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle fs-5"></i>
                                <span>{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <i class="bi bi-person me-2"></i>Profile
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item ms-1">
                            <a class="btn btn-outline-primary btn-sm" href="{{ route('login.form') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm" href="{{ route('register.form') }}">Register</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>

    {{-- ═══════════════ PAGE CONTENT ═══════════════ --}}
    <main>
        {{ $slot }}
    </main>

    {{-- ═══════════════ FOOTER ═══════════════ --}}
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row text-center text-md-start">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-2">
                        <i class="bi bi-bag-heart-fill me-1 text-primary"></i>MyShop
                    </h5>
                    <p class="text-muted small mb-0">Modern e-commerce built with Laravel.</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0 text-center">
                    <h6 class="fw-semibold mb-3">Quick Links</h6>
                    <ul class="list-unstyled small">
                        <li><a href="{{ route('home.index') }}" class="text-muted text-decoration-none">Home</a></li>
                        <li><a href="{{ route('products.index') }}"
                                class="text-muted text-decoration-none">Products</a></li>
                        <li><a href="{{ route('categories.index') }}"
                                class="text-muted text-decoration-none">Categories</a></li>
                    </ul>
                </div>
                <div class="col-md-4 text-md-end">
                    <h6 class="fw-semibold mb-3">Account</h6>
                    <ul class="list-unstyled small">
                        @auth
                            <li><a href="{{ route('profile.show') }}" class="text-muted text-decoration-none">My
                                    Profile</a></li>
                            <li><a href="{{ route('cart.index') }}" class="text-muted text-decoration-none">My Cart</a>
                            </li>
                        @else
                            <li><a href="{{ route('login.form') }}" class="text-muted text-decoration-none">Login</a>
                            </li>
                            <li><a href="{{ route('register.form') }}"
                                    class="text-muted text-decoration-none">Register</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
            <hr class="border-secondary mt-4">
            <p class="text-center text-muted small mb-0">
                &copy; {{ date('Y') }} MyShop. All rights reserved.
            </p>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>

</html>
