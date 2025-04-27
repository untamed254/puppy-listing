<?php
session_start();
include('../Includes/conn.php');

if(isset($_POST['register'])) {
    $user_username = $_POST['username'];
    $user_email = $_POST['admin_email']; 
    $user_password = $_POST['password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $confirmPassword = $_POST['confirmPassword'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    
    // Select query
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$user_username' OR admin_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    
    if($row_count > 0) {
        echo "<script>alert('A User with this Name or Email already exists!')</script>";
    } elseif($user_password != $confirmPassword) {
        echo "<script>alert('Passwords do not match!')</script>";
    } else {
        // Insert Query
        move_uploaded_file($user_image_tmp, "adminImages/$user_image"); 
        $insert_query = "INSERT INTO `admin_table` (admin_name, admin_email, admin_image, admin_password) VALUES ('$user_username', '$user_email', '$user_image', '$hash_password')";
        $sqlExecute = mysqli_query($con, $insert_query);
        
        if($sqlExecute) {
            echo "<script>alert('Registration successful! You can now login.')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            echo "<script>alert('Registration failed! Please try again.')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration - PawaPets Kenya</title>
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

        .register-container {
            width: 100%;
            max-width: 500px;
            padding: 15px;
            margin: auto;
        }

        .register-card {
            border: 0;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            overflow: hidden;
        }

        .register-card-header {
            padding: 1.5rem;
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            text-align: center;
        }

        .register-card-header h3 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .register-card-header p {
            margin-bottom: 0;
            opacity: 0.9;
        }

        .register-card-body {
            padding: 2rem;
            background-color: white;
        }

        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.35rem;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }

        .btn-register {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            padding: 0.75rem;
            font-weight: 600;
            width: 100%;
            border-radius: 0.35rem;
            transition: all 0.3s;
        }

        .btn-register:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        .login-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-color);
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .password-container {
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .file-input-label {
            display: block;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.35rem;
            background-color: #f8f9fc;
            cursor: pointer;
            text-align: center;
            margin-bottom: 1rem;
        }

        .file-input-label:hover {
            background-color: #e9ecef;
        }

        .file-input {
            display: none;
        }

        .preview-image {
            max-width: 100px;
            max-height: 100px;
            margin-top: 10px;
            display: none;
            border-radius: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="card register-card">
            <div class="card-header register-card-header">
                <h3><i class="fas fa-paw"></i> PawaPets Admin</h3>
                <p>Create your administrator account</p>
            </div>
            <div class="card-body register-card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" required>
                    </div>

                    <div class="mb-3">
                        <label for="admin_email" class="form-label">Email Address</label>
                        <input type="email" name="admin_email" class="form-control" id="admin_email" placeholder="Enter email address" required>
                    </div>

                    <div class="mb-3">
                        <label for="user_image" class="form-label">Profile Image</label>
                        <label for="user_image" class="file-input-label">
                            <i class="fas fa-upload me-2"></i>Choose Profile Image
                        </label>
                        <input type="file" name="user_image" class="file-input" id="user_image" accept="image/*">
                        <img id="imagePreview" class="preview-image" src="#" alt="Preview">
                    </div>

                    <div class="mb-3 password-container">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                        <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                    </div>

                    <div class="mb-3 password-container">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Confirm password" required>
                        <i class="fas fa-eye password-toggle" id="toggleConfirmPassword"></i>
                    </div>

                    <button type="submit" class="btn btn-register mb-3" name="register">Register</button>

                    <div class="text-center">
                        <p>Already have an account? <a href="index.php" class="login-link">Login here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        function togglePassword(inputId, toggleId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(toggleId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        document.getElementById('togglePassword').addEventListener('click', function() {
            togglePassword('password', 'togglePassword');
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            togglePassword('confirmPassword', 'toggleConfirmPassword');
        });

        // Image preview
        document.getElementById('user_image').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.style.display = 'block';
                    preview.src = e.target.result;
                }
                
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>