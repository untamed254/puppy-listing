<?php
session_start();
include('../Includes/conn.php');
if(isset($_POST['login'])){
  $user_username=$_POST['username'];
  $user_password=$_POST['password'];

  // select query
   $select_query="Select * from `admin_table` where admin_name='$user_username'";
   $result=mysqli_query($con,$select_query);
   $row_count=mysqli_num_rows($result);
   $row_data=mysqli_fetch_assoc($result);
   if($row_count>0){
      if(password_verify($user_password,$row_data['admin_password'])){
        echo "<script>alert('Login Successful!')</script>";
        $_SESSION['admin_name'] = $user_username;
        setcookie('session_id', uniqid(), time() + 60 * 60 * 24, '/');
        header('Location: dashboard.php');
        exit;
      }else{
        echo "<script>alert('Invalid Credentials!')</script>";
      }
   }else{
    echo "<script>alert('Invalid Credentials!')</script>";
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign In - PawaPets Kenya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --primary-hover: #2e59d9;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
        }

        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: var(--light-color);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: linear-gradient(rgba(78, 115, 223, 0.1), rgba(78, 115, 223, 0.1)), url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAwIDEwIEwgNDAgMTAgTSAxMCAwIEwgMTAgNDAgTSAwIDIwIEwgNDAgMjAgTSAyMCAwIEwgMjAgNDAgTSAwIDMwIEwgNDAgMzAgTSAzMCAwIEwgMzAgNDAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iI2UwZTBlMCIgb3BhY2l0eT0iMC4yIiBzdHJva2Utd2lkdGg9IjEiLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JpZCkiLz48L3N2Zz4=');
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 15px;
            margin: auto;
        }

        .login-card {
            border: 0;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            overflow: hidden;
        }

        .login-card-header {
            padding: 1.5rem;
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            text-align: center;
        }

        .login-card-header h3 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-card-header p {
            margin-bottom: 0;
            opacity: 0.9;
        }

        .login-card-body {
            padding: 2rem;
            background-color: white;
        }

        .login-logo {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .login-logo i {
            margin-right: 0.5rem;
        }

        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.35rem;
        }

        .btn-login {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            padding: 0.75rem;
            font-weight: 600;
            width: 100%;
            border-radius: 0.35rem;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        .input-group-text {
            background-color: white;
            border-left: 0;
        }

        .password-toggle {
            cursor: pointer;
            background-color: white;
            border-left: 0;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .forgot-password {
            color: var(--secondary-color);
            font-size: 0.85rem;
        }

        .forgot-password:hover {
            color: var(--primary-color);
            text-decoration: none;
        }

        /* Modal styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1050;
        }

        .password-modal-content {
            background-color: white;
            border-radius: 0.5rem;
            width: 100%;
            max-width: 400px;
            padding: 1.5rem;
            position: relative;
        }

        .close-modal-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--secondary-color);
        }

        .modal-title {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .modal-step {
            display: none;
        }

        .modal-step.active {
            display: block;
        }

        .resend-link {
            color: var(--primary-color);
            font-size: 0.85rem;
        }

        .resend-link:hover {
            text-decoration: none;
        }

        .user-email {
            font-weight: 600;
            color: var(--dark-color);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card login-card">
            <div class="card-header login-card-header">
                <h3><i class="fas fa-paw"></i> PawaPets Admin</h3>
                <p>Kenya's Premier Pet Community</p>
            </div>
            <div class="card-body login-card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required placeholder="Enter your username">
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                            <button class="btn btn-outline-secondary password-toggle" type="button" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="text-end mt-2">
                            <a href="#" class="forgot-password" id="forgotPasswordTrigger">Forgot password?</a>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-login mb-3" name="login">Sign In</button>

                    <div class="text-center">
                        <p>Don't have an account? <a href="register.php" class="login-link">Register here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div class="modal-overlay" id="forgotPasswordModal">
        <div class="password-modal-content">
            <button class="close-modal-btn">&times;</button>
            <h3 class="modal-title">Reset Password</h3>
            
            <!-- Step 1: Email Input -->
            <div class="modal-step active" id="step1">
                <p>Enter your email to receive a reset link</p>
                <form id="emailForm">
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Your email address" required>
                    </div>
                    <button type="submit" class="btn btn-login">Continue</button>
                </form>
            </div>
            
            <!-- Step 2: Verification Code -->
            <div class="modal-step" id="step2">
                <p>We sent a 6-digit code to <span class="user-email">user@example.com</span></p>
                <form id="verificationForm">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Enter 6-digit code" maxlength="6" required>
                    </div>
                    <button type="submit" class="btn btn-login">Verify Code</button>
                    <p class="text-center mt-2">
                        <a href="#" class="resend-link">Resend code</a>
                    </p>
                </form>
            </div>
            
            <!-- Step 3: New Password -->
            <div class="modal-step" id="step3">
                <form id="newPasswordForm">
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="New password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Confirm new password" required>
                    </div>
                    <button type="submit" class="btn btn-login">Update Password</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });

        // Forgot password modal
        const forgotPasswordTrigger = document.getElementById('forgotPasswordTrigger');
        const forgotPasswordModal = document.getElementById('forgotPasswordModal');
        const closeModalBtn = document.querySelector('.close-modal-btn');
        
        forgotPasswordTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            forgotPasswordModal.style.display = 'flex';
        });
        
        closeModalBtn.addEventListener('click', function() {
            forgotPasswordModal.style.display = 'none';
        });
        
        // Close modal when clicking outside
        forgotPasswordModal.addEventListener('click', function(e) {
            if (e.target === forgotPasswordModal) {
                forgotPasswordModal.style.display = 'none';
            }
        });

        // Form step handling (simplified for demo)
        document.getElementById('emailForm').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('step1').classList.remove('active');
            document.getElementById('step2').classList.add('active');
            // In a real app, you would send the email and handle the response
        });
        
        document.getElementById('verificationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('step2').classList.remove('active');
            document.getElementById('step3').classList.add('active');
        });
        
        document.getElementById('newPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Password updated successfully!');
            forgotPasswordModal.style.display = 'none';
            // Reset forms
            document.getElementById('step3').classList.remove('active');
            document.getElementById('step1').classList.add('active');
            this.reset();
            document.getElementById('emailForm').reset();
        });
    </script>
</body>
</html>