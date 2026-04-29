<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - SMK FH NUSANTARA</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #003f87 0%, #001f4d 100%);
        }

        /* Container */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Card Login */
        .login-card {
            max-width: 440px;
            width: 100%;
            background: white;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Logo */
        .login-logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-logo img {
            height: 60px;
            width: auto;
        }

        /* Header */
        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .login-header p {
            font-size: 14px;
            color: #64748b;
        }

        /* Form */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 13px;
            color: #334155;
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.2s;
            outline: none;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Checkbox */
        .checkbox-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-container input {
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: #2563eb;
        }

        .checkbox-container label {
            font-size: 13px;
            color: #64748b;
            cursor: pointer;
            margin: 0;
        }

        .forgot-link a {
            font-size: 13px;
            color: #2563eb;
            text-decoration: none;
        }

        .forgot-link a:hover {
            text-decoration: underline;
        }

        /* Button */
        .btn-login {
            width: 100%;
            background: #2563eb;
            border: none;
            padding: 12px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-login:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }

        /* Alert */
        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-error {
            background: #fee2e2;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        .alert-success {
            background: #e6f7e6;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        /* Back Link */
        .back-link {
            text-align: center;
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
        }

        .back-link a {
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .back-link a:hover {
            color: #2563eb;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 24px;
            }
            .login-logo img {
                height: 50px;
            }
            .login-header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Logo -->
            <div class="login-logo">
                <img src="{{ asset('images/logo-smk.png') }}" alt="SMK FH NUSANTARA"
                     onerror="this.src='https://placehold.co/60x60/2563eb/white?text=S'; this.onerror=null;">
            </div>

            <!-- Header -->
            <div class="login-header">
                <h1>Selamat Datang</h1>
                <p>Silakan login untuk mengakses panel administrasi</p>
            </div>

            <!-- Alert -->
            @if(session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i> {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="admin@example.com">
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="••••••">
                </div>

                <div class="checkbox-group">
                    <div class="checkbox-container">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <div class="forgot-link">
                            <a href="{{ route('password.request') }}">Lupa password?</a>
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </button>
            </form>

            <!-- Back Link -->
            <div class="back-link">
                <a href="{{ route('home') }}">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Website</span>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>