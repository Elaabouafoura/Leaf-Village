<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Green Spaces Management</title>
    <link rel="shortcut icon" href="{{ asset('images/images.png') }}" />
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

        .reset-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1000px;
            padding: 20px;
        }

        .reset-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: var(--transition);
        }

        .reset-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.35);
        }

        .reset-left {
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

        .reset-left::before {
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

        .reset-icon {
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

        .reset-icon:hover {
            transform: scale(1.1);
            background: rgba(255, 255, 255, 0.3);
        }

        .reset-icon i {
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
            transition: var(--transition);
        }

        .password-toggle:hover {
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

        .success-message {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border: 1px solid #c3e6cb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            display: none;
        }

        .success-message.show {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        .password-strength {
            height: 4px;
            border-radius: 2px;
            margin-top: 5px;
            transition: var(--transition);
        }

        .strength-weak { background: #dc3545; width: 25%; }
        .strength-fair { background: #fd7e14; width: 50%; }
        .strength-good { background: #ffc107; width: 75%; }
        .strength-strong { background: #28a745; width: 100%; }

        .requirement-list {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            margin-top: 10px;
            border-left: 4px solid #38ef7d;
        }

        .requirement-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .requirement-item.valid {
            color: #28a745;
        }

        .requirement-item.invalid {
            color: #6c757d;
        }

        .requirement-item i {
            margin-right: 8px;
            font-size: 12px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 992px) {
            .reset-left {
                min-height: 400px;
                padding: 40px 30px;
            }
            
            .reset-icon {
                width: 100px;
                height: 100px;
            }
            
            .reset-icon i {
                font-size: 48px;
            }
        }

        @media (max-width: 768px) {
            .reset-container {
                padding: 15px;
            }
            
            .reset-card {
                border-radius: 20px;
            }
            
            .reset-left {
                min-height: 300px;
                padding: 30px 20px;
            }
            
            .reset-icon {
                width: 80px;
                height: 80px;
                margin-bottom: 20px;
            }
            
            .reset-icon i {
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

    <div class="reset-container">
        <div class="row g-0">
            <div class="col-12">
                <div class="reset-card">
                    <div class="row g-0">
                        <!-- Left Side - Branding -->
                        <div class="col-lg-5 col-md-5 d-none d-md-block">
                            <div class="reset-left">
                                <div class="reset-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <h2 class="fw-bold mb-3 text-white">New Password</h2>
                                <p class="mb-4">Create a strong, secure password to protect your account.</p>
                                <div class="d-flex gap-4 justify-content-center mt-4">
                                    <div class="feature-item text-center">
                                        <i class="fas fa-shield-alt fs-4 mb-2 d-block"></i>
                                        <small>Secure</small>
                                    </div>
                                    <div class="feature-item text-center">
                                        <i class="fas fa-check-circle fs-4 mb-2 d-block"></i>
                                        <small>Verified</small>
                                    </div>
                                    <div class="feature-item text-center">
                                        <i class="fas fa-user-lock fs-4 mb-2 d-block"></i>
                                        <small>Protected</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side - Reset Password Form -->
                        <div class="col-lg-7 col-md-7">
                            <div class="p-5">
                                <!-- Mobile Branding (only visible on small screens) -->
                                <div class="d-md-none text-center mb-4">
                                    <div class="reset-icon mx-auto mb-3">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    <h3 class="fw-bold">New Password</h3>
                                    <p class="text-muted">Create your new password</p>
                                </div>

                                <div class="text-center mb-4">
                                    <h3 class="fw-bold text-dark">Reset Password</h3>
                                    <p class="text-muted">Enter your new password below</p>
                                </div>

                                <!-- Success Message -->
                                <div class="success-message" id="successMessage">
                                    <div class="text-center">
                                        <i class="fas fa-check-circle text-success fs-1 mb-3"></i>
                                        <h5 class="text-success mb-2">Password Updated!</h5>
                                        <p class="mb-0">Your password has been successfully reset. You can now login with your new password.</p>
                                        <a href="{{ route('signin') }}" class="btn btn-success mt-3">
                                            <i class="fas fa-sign-in-alt me-2"></i>Go to Login
                                        </a>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('reset') }}" id="resetForm">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    @error('token')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                        

                                    <!-- Email -->
                                    <div class="mb-4">
                                        <label for="email" class="form-label fw-semibold mb-3">
                                            Email
                                        </label>
                                        <div class="input-group">
                                            <i class="fas fa-lock input-icon"></i>
                                            <input type="email" class="form-control form-control-lg" id="email" 
                                                   name="email" placeholder="Enter email" >
                                            
                                        </div>
                                        @error('email')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <!-- New Password -->
                                    <div class="mb-4">
                                        <label for="password" class="form-label fw-semibold mb-3">
                                            New Password
                                        </label>
                                        <div class="input-group">
                                            <i class="fas fa-lock input-icon"></i>
                                            <input type="password" class="form-control form-control-lg" id="password" 
                                                   name="password" placeholder="Enter new password" required>
                                            <button type="button" class="password-toggle" id="toggleNewPassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <!-- Password Strength Meter -->
                                        <div class="password-strength" id="passwordStrength"></div>
                                        @error('password')
                                        <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label fw-semibold mb-3">
                                            Confirm New Password
                                        </label>
                                        <div class="input-group">
                                            <i class="fas fa-lock input-icon"></i>
                                            <input type="password" class="form-control form-control-lg" id="password_confirmation" 
                                                   name="password_confirmation" placeholder="Confirm new password" required>
                                            <button type="button" class="password-toggle" id="toggleConfirmPassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="mt-2" id="passwordMatch"></div>
                                    </div>

                                    <!-- Password Requirements -->
                                    <div class="requirement-list">
                                        <h6 class="fw-semibold mb-3">Password Requirements:</h6>
                                        <div class="requirement-item invalid" id="reqLength">
                                            <i class="fas fa-circle"></i>
                                            <span>At least 8 characters</span>
                                        </div>
                                        <div class="requirement-item invalid" id="reqLowercase">
                                            <i class="fas fa-circle"></i>
                                            <span>One lowercase letter</span>
                                        </div>
                                        <div class="requirement-item invalid" id="reqUppercase">
                                            <i class="fas fa-circle"></i>
                                            <span>One uppercase letter</span>
                                        </div>
                                        <div class="requirement-item invalid" id="reqNumber">
                                            <i class="fas fa-circle"></i>
                                            <span>One number</span>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-success w-100 py-3 mb-4 mt-4" id="submitBtn">
                                        <i class="fas fa-save me-2"></i>Reset Password
                                    </button>

                                    <!-- Back to Login -->
                                    <div class="text-center">
                                        <p class="mb-0">
                                            <a href="{{ route('login') }}" class="text-success fw-semibold text-decoration-none">
                                                <i class="fas fa-arrow-left me-2"></i>Back to Login
                                            </a>
                                        </p>
                                    </div>
                                </form>

                                <!-- Support Info -->
                                <div class="text-center mt-4 pt-4 border-top">
                                    <small class="text-muted">
                                        Having trouble? Contact our 
                                        <a href="#" class="text-success text-decoration-none">support team</a>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>