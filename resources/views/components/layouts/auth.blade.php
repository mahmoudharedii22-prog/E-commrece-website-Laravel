<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#4f46e5">
    <title>{{ $title ?? 'Authentication' }} | ShopName</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts: Figtree -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand-primary:   #4f46e5;
            --brand-hover:     #4338ca;
            --card-shadow:     0 4px 6px -1px rgba(0,0,0,.07),
                               0 20px 40px -8px rgba(79,70,229,.12);
            --input-radius:    8px;
            --card-radius:     16px;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f0f2ff;
            background-image:
                radial-gradient(ellipse 80% 60% at 20% -10%, rgba(99,102,241,.18) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 110%,  rgba(139,92,246,.14) 0%, transparent 55%);
            min-height: 100vh;
        }

        /* ── Layout ─────────────────────────────── */
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        /* ── Brand mark ─────────────────────────── */
        .auth-brand {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .auth-brand-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: var(--brand-primary);
            margin-bottom: .5rem;
        }

        .auth-brand-logo svg {
            width: 26px;
            height: 26px;
            fill: none;
            stroke: #fff;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .auth-brand-name {
            font-size: .95rem;
            font-weight: 700;
            letter-spacing: .04em;
            color: #1e1b4b;
            text-transform: uppercase;
        }

        /* ── Card ───────────────────────────────── */
        .auth-card {
            width: 100%;
            max-width: 440px;
            border: 1px solid rgba(255,255,255,.9);
            border-radius: var(--card-radius);
            box-shadow: var(--card-shadow);
            background: #fff;
            padding: 2.25rem 2.5rem;
        }

        @media (max-width: 480px) {
            .auth-card { padding: 1.75rem 1.5rem; }
        }

        /* ── Heading ────────────────────────────── */
        .auth-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: .35rem;
        }

        .auth-subtitle {
            font-size: .875rem;
            color: #6b7280;
            margin-bottom: 1.75rem;
        }

        /* ── Form controls ──────────────────────── */
        .form-label {
            font-size: .82rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: .4rem;
            letter-spacing: .01em;
        }

        .form-control {
            border-radius: var(--input-radius);
            border: 1.5px solid #e5e7eb;
            padding: .6rem .85rem;
            font-size: .9rem;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-control:focus {
            border-color: var(--brand-primary);
            box-shadow: 0 0 0 3px rgba(79,70,229,.12);
        }

        .form-control.is-invalid { border-color: #ef4444; }

        /* ── Primary button ─────────────────────── */
        .btn-primary {
            background-color: var(--brand-primary);
            border-color:     var(--brand-primary);
            border-radius:    var(--input-radius);
            font-weight: 600;
            letter-spacing: .02em;
            padding: .65rem 1rem;
            transition: background-color .2s, transform .1s;
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--brand-hover);
            border-color:     var(--brand-hover);
        }

        .btn-primary:active { transform: scale(.98); }

        /* ── Alerts ─────────────────────────────── */
        .alert {
            font-size: .875rem;
            border-radius: var(--input-radius);
            padding: .7rem 1rem;
            border: none;
        }

        /* ── Footer ─────────────────────────────── */
        .auth-footer {
            margin-top: 1.5rem;
            font-size: .78rem;
            color: #9ca3af;
            text-align: center;
        }
    </style>

    @stack('styles')
</head>

<body>

    <div class="auth-wrapper">

        {{-- Brand mark --}}
        <div class="auth-brand">
            <div class="auth-brand-logo" aria-hidden="true">
                {{-- Simple bag / shop icon (inline SVG, no emoji) --}}
                <svg viewBox="0 0 24 24">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <path d="M16 10a4 4 0 0 1-8 0"/>
                </svg>
            </div>
            <div class="auth-brand-name">ShopName</div>
        </div>

        {{-- Auth card --}}
        <div class="auth-card" role="main">

            {{-- Title block --}}
            <h1 class="auth-title">{{ $title ?? 'Welcome back' }}</h1>
            @isset($subtitle)
                <p class="auth-subtitle">{{ $subtitle }}</p>
            @else
                <p class="auth-subtitle">Please sign in to continue.</p>
            @endisset

            {{-- Flash messages ──────────────────────────────────────
                 Supports: success, error, warning, info
            ──────────────────────────────────────────────────────── --}}
            <div aria-live="polite">
                @foreach (['success' => 'success', 'error' => 'danger', 'warning' => 'warning', 'info' => 'info'] as $flash => $bsClass)
                    @if (session($flash))
                        <div class="alert alert-{{ $bsClass }} alert-dismissible fade show mb-3" role="alert">
                            {{ session($flash) }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- Validation error summary ──────────────────────────
                 Shows all field errors in one place (optional: remove
                 if each field already shows inline errors below it)
            ──────────────────────────────────────────────────────── --}}
            @if ($errors->any())
                <div class="alert alert-danger mb-3" role="alert">
                    <strong>Please fix the following:</strong>
                    <ul class="mb-0 mt-1 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Page-specific content --}}
            {{ $slot }}

        </div>

        {{-- Footer --}}
        <p class="auth-footer">
            &copy; {{ date('Y') }} ShopName. All rights reserved.
        </p>

    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>
</html>