<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification - Green Spaces Management</title>
    <link rel="shortcut icon" href="{{ asset('images/images.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Paste your register/login page styles here */
        /* For simplicity, we will reuse the same floating-shapes and card styles */
        :root {
            --primary-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --secondary-gradient: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #7dd3c0 100%);
            --shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            --transition: all 0.3s ease;
        }
        body {
            background: var(--secondary-gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-x: hidden;
        }
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        .shape {
            position: absolute;
            opacity: 0.1;
            border-radius: 50%;
            background: white;
            animation: float 15s infinite linear;
        }
        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            box-shadow: var(--shadow);
            overflow: hidden;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            text-align: center;
            z-index: 1;
        }
        .btn-success {
            background: var(--primary-gradient);
            border: none;
            padding: 15px 30px;
            font-weight: 600;
            border-radius: 12px;
        }
        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(56, 239, 125, 0.4);
        }
        .btn-danger {
            border-radius: 12px;
            padding: 12px 30px;
        }
        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
            100% { transform: translateY(0) rotate(360deg); }
        }
    </style>
</head>
<body>

    <div class="floating-shapes">
        <div class="shape" style="width:80px; height:80px; top:10%; left:10%;"></div>
        <div class="shape" style="width:120px; height:120px; top:70%; left:80%;"></div>
        <div class="shape" style="width:60px; height:60px; top:20%; left:85%;"></div>
        <div class="shape" style="width:100px; height:100px; top:80%; left:15%;"></div>
    </div>

    <div class="register-card">
        <div class="mb-4">
            <i class="fas fa-envelope fa-3x text-success mb-3"></i>
            <h3 class="fw-bold">Verify Your Email</h3>
            <p class="text-muted">
                Thanks for registering, <strong>{{ auth()->user()->nom }}</strong>!<br>
                Before continuing, please check your email for a verification link.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">
                A new verification link has been sent to your email address.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-success mb-2">Resend Verification Email</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

</body>
</html>
