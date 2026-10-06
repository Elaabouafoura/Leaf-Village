<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Green Spaces Management</title>
      <link rel="shortcut icon"  href="{{ asset('images/images.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --secondary-gradient: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #7dd3c0 100%);
            --shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: var(--secondary-gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: bottom;
            opacity: 0.3;
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

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 70%;
            left: 80%;
            animation-delay: -5s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 20%;
            left: 85%;
            animation-delay: -10s;
        }

        .shape:nth-child(4) {
            width: 100px;
            height: 100px;
            top: 80%;
            left: 15%;
            animation-delay: -7s;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
            100% {
                transform: translateY(0) rotate(360deg);
            }
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1200px;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: var(--transition);
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.35);
        }

        .login-left {
            background: var(--primary-gradient);
            padding: 60px 40px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            min-height: 100%;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="white" opacity="0.3"/><circle cx="80" cy="60" r="3" fill="white" opacity="0.2"/><circle cx="50" cy="80" r="2" fill="white" opacity="0.3"/></svg>');
            background-size: 100px 100px;
            opacity: 0.2;
        }

        .login-icon {
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            position: relative;
            transition: var(--transition);
        }

        .login-icon:hover {
            transform: scale(1.1);
            background: rgba(255, 255, 255, 0.3);
        }

        .login-icon i {
            font-size: 54px;
        }

        .form-control {
            border-radius: 12px;
            padding: 15px 20px;
            border: 2px solid #e9ecef;
            transition: var(--transition);
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #38ef7d;
            box-shadow: 0 0 0 0.2rem rgba(56, 239, 125, 0.25);
            transform: translateY(-2px);
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #38ef7d;
            z-index: 5;
        }

        .input-group .form-control {
            padding-left: 50px;
        }

        .btn-success {
            background: var(--primary-gradient);
            border: none;
            padding: 15px;
            font-weight: 600;
            transition: var(--transition);
            border-radius: 12px;
            font-size: 16px;
            letter-spacing: 0.5px;
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(56, 239, 125, 0.4);
        }

        .btn-outline-secondary {
            border-radius: 12px;
            padding: 12px;
            transition: var(--transition);
            border: 2px solid #e9ecef;
        }

        .btn-outline-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .leaf-icon {
            color: #38ef7d;
        }

        .feature-item {
            transition: var(--transition);
            padding: 10px;
            border-radius: 10px;
        }

        .feature-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        .social-divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
        }

        .social-divider::before,
        .social-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e9ecef;
        }

        .social-divider span {
            padding: 0 15px;
            color: #6c757d;
            font-size: 14px;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            z-index: 5;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transform: translateX(150%);
            transition: transform 0.5s ease;
            z-index: 1000;
            border-left: 4px solid #38ef7d;
        }

        .notification.show {
            transform: translateX(0);
        }

        @media (max-width: 992px) {
            .login-left {
                min-height: 400px;
                padding: 40px 30px;
            }
            
            .login-icon {
                width: 100px;
                height: 100px;
            }
            
            .login-icon i {
                font-size: 48px;
            }
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 15px;
            }
            
            .login-card {
                border-radius: 20px;
            }
            
            .login-left {
                min-height: 300px;
                padding: 30px 20px;
            }
            
            .login-icon {
                width: 80px;
                height: 80px;
                margin-bottom: 20px;
            }
            
            .login-icon i {
                font-size: 36px;
            }
        }
    </style>
</head>
<body>
    <!-- Floating background shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>



    <div class="login-container">
        <div class="row g-0">
            <div class="col-12">
                <div class="login-card">
                    <div class="row g-0">
                        <!-- Left Side - Branding -->
                        <div class="col-lg-5 col-md-5 d-none d-md-block">
                            <div class="login-left">
                                <div class="login-icon">
                                    <i class="fas fa-leaf"></i>
                                </div>
                                <h2 class="fw-bold mb-3 text-white">Leaf Village</h2>
                                <p class="mb-4">Join us in creating a sustainable future. Monitor, manage, and grow green spaces in your community.</p>
                                <div class="d-flex gap-4 justify-content-center mt-4">
                                    <div class="feature-item text-center">
                                        <i class="fas fa-tree fs-4 mb-2 d-block"></i>
                                        <small>Parks</small>
                                    </div>
                                    <div class="feature-item text-center">
                                        <i class="fas fa-users fs-4 mb-2 d-block"></i>
                                        <small>Community</small>
                                    </div>
                                    <div class="feature-item text-center">
                                        <i class="fas fa-chart-bar fs-4 mb-2 d-block"></i>
                                        <small>Analytics</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side - Login Form -->
                        <div class="col-lg-7 col-md-7">
                            <div class="p-5">
                                <!-- Mobile Branding (only visible on small screens) -->
                                <div class="d-md-none text-center mb-4">
                                    <div class="login-icon mx-auto mb-3">
                                        <i class="fas fa-leaf"></i>
                                    </div>
                                    <h3 class="fw-bold">Green Spaces</h3>
                                    <p class="text-muted">Management System</p>
                                </div>

                                <div class="text-center mb-4">
                                    <h3 class="fw-bold text-dark">Welcome Back!</h3>
                                    <p class="text-muted">Sign in to your account</p>
                                </div>

                                <form method="POST" action="{{ route('signin') }}" id="loginForm">
                                    @csrf
                                    
                                    <!-- Email -->
                                    <div class="mb-4">
                                        <label for="email" class="form-label fw-semibold mb-3">
                                            Email Address
                                        </label>
                                        <div class="input-group">
                                            <i class="fas fa-envelope input-icon"></i>
                                            <input type="email" class="form-control form-control-lg" id="email" 
                                                   name="email" placeholder="Enter your email" required autofocus>
                                        </div>
                                        @error('email')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-4">
                                        <label for="motDePasse" class="form-label fw-semibold mb-3">
                                            Password
                                        </label>
                                        <div class="input-group">
                                            <i class="fas fa-lock input-icon"></i>
                                            <input type="password" class="form-control form-control-lg" id="motDePasse" 
                                                   name="motDePasse" placeholder="Enter your password" required>
                                            <button type="button" class="password-toggle" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('motDePasse')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Remember Me & Forgot Password -->
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                            <label class="form-check-label text-dark" for="remember">
                                                Remember me
                                            </label>
                                        </div>
                                        <a href="{{ route('password.request') }}" class="text-success fw-semibold text-decoration-none">
                                            Forgot Password?
                                        </a>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-success w-100 py-3 mb-4">
                                        <i class="fas fa-sign-in-alt me-2"></i>Sign In
                                    </button>
<div class="social-divider">
    <span>or</span>
</div>

<a href="{{ route('google.login') }}" class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center">
    <i class="fab fa-google me-2 text-danger"></i> Se connecter avec Google
</a>

                                    <!-- Register Link -->
                                    <div class="text-center">
                                        <p class="mb-0">Don't have an account? 
                                            <a href="{{ route('register') }}" class="text-success fw-semibold text-decoration-none">
                                                Create Account
                                            </a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script>

    </script>
</body>
</html>