<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Manajemen Soal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body class="login-body" style="background-image: url('{{ asset('assets/images/i1.webp') }}')">
    <div class="login-container">
        <div class="login-overlay"></div>

        <div class="login-form-wrapper">
            <div class="login-form-container glass-card">
                <div class="login-header">
                    <h2 class="login-form-title">Welcome Back</h2>
                    <p class="login-form-subtitle">Sistem Manajemen Soal</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ url('/login') }}" method="POST" class="login-form">
                    @csrf

                    <div class="form-group mb-4">
                        <label class="form-label">Your email</label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="user@example.com"
                                value="{{ old('email') }}"
                                required
                            >
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-group input-group-custom">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Password"
                                required
                            >
                            <span class="input-group-text input-eye-icon" role="button" tabindex="0">
                                <i class="bi bi-eye-slash" data-toggle="password"></i>
                            </span>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="keepSignedIn" name="remember">
                        <label class="form-check-label" for="keepSignedIn">
                            Keep me signed in
                        </label>
                    </div>

                    <button type="submit" class="btn btn-login w-100 mb-3">
                        Sign in
                    </button>

                    <div class="divider-text">
                        <span>or</span>
                    </div>

                    <div class="register-section">
                        <p class="register-text">Don't have an account? <a href="{{ url('/register') }}" class="register-link">Register here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Password toggle functionality
        document.querySelectorAll('[data-toggle="password"]').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.closest('.input-group').querySelector('input[type="password"], input[type="text"]');
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                }
            });
        });
    </script>
</body>
</html>
