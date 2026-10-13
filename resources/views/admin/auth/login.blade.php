<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Emak Natural Clinic Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, var(--ek-forest-dark), var(--ek-forest) 60%, var(--ek-leaf-dark) 130%);
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
        }
        .ek-login-card { background:#fff; border-radius: var(--ek-radius); box-shadow: 0 20px 60px rgba(0,0,0,.25); padding: 2.5rem; width: 100%; max-width: 420px; }
        .ek-login-brand { text-align:center; margin-bottom: 1.5rem; }
        .ek-login-brand i { font-size: 2.4rem; color: var(--ek-leaf); }
    </style>
</head>
<body>
    <div class="ek-login-card">
        <div class="ek-login-brand">
            <i class="bi bi-flower2"></i>
            <h4 class="mt-2 mb-0">Emak Natural Clinic</h4>
            <p class="text-muted small">Admin / Receptionist Login</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="{{ old('username') }}" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn btn-ek-primary w-100">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>
        </form>

        <p class="text-center text-muted small mt-4 mb-0">
            <i class="bi bi-shield-lock"></i> Default admin: <code>admin</code> / see your .env
        </p>
    </div>
</body>
</html>
