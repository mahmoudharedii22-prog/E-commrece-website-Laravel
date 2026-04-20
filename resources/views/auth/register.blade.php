<x-layouts.auth title="Create an Account">
    <form action="{{ url('/register') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                name="phone" value="{{ old('phone') }}" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="avatar" class="form-label">Avatar (optional)</label>
            <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar"
                name="avatar">
            @error('avatar')
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

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2">Register</button>

        <div class="text-center mt-3">
            <small>Already have an account? <a href="{{ url('/login') }}">Login</a></small>
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
