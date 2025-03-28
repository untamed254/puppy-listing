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
        // echo "<script>window.open('dashboard.php','_self')</script>";
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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Admin Sign In - PawaPets Kenya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
      
    </style>
</head>
<body>
    <div class="signin-container">
        <div class="signin-card">
            <div class="signin-header">
                <div class="signin-logo">Admin PawaPets</div>
                <p>Welcome back to Kenya's pet community</p>
            </div>
            
            <div class="signin-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Username</label>
                        <input type="text" class="form-control" id="email" name="username" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="text-end mt-2">
                            <a href="#" id= "forgotPasswordTrigger" class="text-decoration-none">Forgot password?</a>
                        </div>
                    </div>
                    
                    <input type="submit" class="btn btn-signin mb-3" name="login"></input>
                </form>
            </div>
        </div>
    </div>
<!-- Forgot Password Modal Structure -->
<div class="modal-overlay" id="forgotPasswordModal">
  <div class="password-modal-content">
    <button class="close-modal-btn">&times;</button>
    <h3 class="modal-title">Reset Password</h3>
    
    <!-- Step 1: Email Input -->
    <div class="modal-step active" id="step1">
      <p>Enter your email to receive a reset link</p>
      <form id="emailForm">
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Your email address" required>
        </div>
        <button type="submit" class="btn btn-warning w-100 mt-3">Continue</button>
      </form>
    </div>
    
    <!-- Step 2: Verification Code -->
    <div class="modal-step" id="step2">
      <p>We sent a 6-digit code to <span class="user-email">user@example.com</span></p>
      <form id="verificationForm">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter 6-digit code" maxlength="6" required>
        </div>
        <button type="submit" class="btn btn-warning w-100 mt-3">Verify Code</button>
        <p class="text-center mt-2">
          <a href="#" class="resend-link">Resend code</a>
        </p>
      </form>
    </div>
    
    <!-- Step 3: New Password -->
    <div class="modal-step" id="step3">
      <form id="newPasswordForm">
        <div class="form-group">
          <input type="password" class="form-control" placeholder="New password" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Confirm new password" required>
        </div>
        <button type="submit" class="btn btn-warning w-100 mt-3">Update Password</button>
      </form>
    </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
</body>
</html>