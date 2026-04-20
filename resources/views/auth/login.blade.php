<x-layouts.auth title="Sign In">
    <form action="{{ route('login') }}" method="POST" novalidate>
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 position-relative">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" required>
                <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i
                        class="bi bi-eye"></i></button>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <a href="{{ url('/password/reset') }}" class="text-decoration-none">Forgot password?</a>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2">Login</button>

        <div class="text-center mt-3">
            <small>Don’t have an account? <a href="{{ url('/register') }}">Register</a></small>
        </div>
    </form>

    @push('scripts')
        <script>
            const toggleBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            toggleBtn.addEventListener('click', function() {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
                this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
            });
        </script>
    @endpush
</x-layouts.auth>
