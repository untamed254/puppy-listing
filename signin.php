<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - PawaPets Kenya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --paw-yellow: #FFC107;
            --paw-dark: #2C3E50;
            --paw-light: #F8F9FA;
        }
        
        body {
            background-color: var(--paw-light);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            display: flex;
            min-height: 100vh;
            align-items: center;
        }
        
        .signin-container {
            max-width: 450px;
            width: 100%;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .signin-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        
        .signin-header {
            background: linear-gradient(135deg, var(--paw-yellow), #FFAB00);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .signin-logo {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .signin-body {
            padding: 2rem;
            background: white;
        }
        
        .form-control {
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--paw-yellow);
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
        }
        
        .btn-signin {
            background: linear-gradient(135deg, var(--paw-yellow), #FFAB00);
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s;
        }
        
        .btn-signin:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #6c757d;
        }
        
        .divider::before, .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .divider::before {
            margin-right: 1rem;
        }
        
        .divider::after {
            margin-left: 1rem;
        }
        
        .social-btn {
            display: flex;
            align-items: center;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            border: 1px solid #e0e0e0;
            background: white;
            transition: all 0.3s;
        }
        
        .social-btn:hover {
            background: #f8f9fa;
        }
        
        .social-btn i {
            margin-right: 8px;
            font-size: 1.2rem;
        }
        
        .google-btn {
            color: #DB4437;
        }
        
        .signup-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        @media (max-width: 576px) {
            .signin-container {
                padding: 1rem;
            }
            
            .signin-header {
                padding: 1.5rem;
            }
            
            .signin-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="signin-container">
        <div class="signin-card">
            <div class="signin-header">
                <div class="signin-logo">PawaPets</div>
                <p>Welcome back to Kenya's pet community</p>
            </div>
            
            <div class="signin-body">
                <form id="signinForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="text-end mt-2">
                            <a href="/forgot-password" class="text-decoration-none">Forgot password?</a>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-signin mb-3">Sign In</button>
                    
                    <div class="divider">or continue with</div>
                    
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <button type="button" class="social-btn google-btn">
                                <i class="fab fa-google"></i> Google
                            </button>
                        </div>
                    </div>
                    
                    <div class="signup-link">
                        Don't have an account? <a href="registration.php" class="text-warning">Sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password visibility toggle
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });
            
            // Form submission
            const signinForm = document.getElementById('signinForm');
            
            signinForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                
                // Basic validation
                if (!email || !password) {
                    alert('Please fill in all fields');
                    return;
                }
                
                // Here you would typically make an API call
                console.log('Signing in with:', { email, password });
                
                // Simulate successful login
                alert('Login successful! Redirecting...');
                // window.location.href = '/dashboard';
            });
            
            // Social login handlers
            document.querySelector('.google-btn').addEventListener('click', function() {
                console.log('Google login clicked');
                // Implement Google OAuth here
            });
            
            document.querySelector('.facebook-btn').addEventListener('click', function() {
                console.log('Facebook login clicked');
                // Implement Facebook OAuth here
            });
        });
    </script>
</body>
</html>