<?php  include('../Includes/conn.php'); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Admin | Login</title>
  </head>
  <body style=" background: url('Images/bg1.jpg'); z-index: -1; " class="">
    <div class="container d-flex justify-content-center align-items-center my-auto" style="height:100vh; width: 500px;">
        
        <!-- form -->
        <div class="container-fluid border border-5 border-warning rounded-3 shadow-lg bg-light">
        <h1 class="text-center text-warning mt-2">PetPawa Admin Register</h1>
        <h3 class="text-center text-dark">Register</h3>
        <form action="" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" name="username" require="required" placeholder="Enter username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="text" name="admin_email" require="required" placeholder="Enter Email address" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputfile" class="form-label">Profile Image</label>
    <input type="file" name="user_image" require="required"  class="form-control" id="exampleInputfile">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" require="required" placeholder="Enter preferred Password" class="form-control" id="exampleInputPassword1">
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
    <input type="password" name="confirmPassword" require="required" placeholder="Confirm your Password" class="form-control" id="exampleInputPassword2">
    
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Show Password</label>
  </div>
  <div class="text-center d-grid mb-2">
  <input type="submit" class="btn btn-outline-warning" name="register" value="Register"></input>
  </div>
  <div class="text-center mb-3">
  <a href="index.php" class="mt-3 text-warning text-decoration-none">Already have an Account?</a>
 
  </div>
</form>
        </div>
   
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>

<!-- PHP registration logic -->
<?php
if(isset($_POST['register'])){
    $user_username=$_POST['username'];
    $user_email=$_POST['admin_email']; 
    $user_password=$_POST['password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $confirmPassword=$_POST['confirmPassword'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    
  //  Select query
    $select_query="Select * from `admin_table` where admin_name='$user_username'or admin_email='$user_email'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    if($row_count>0){
      echo "<script>alert('A User with this Name and Email already exists!')</script>";
    }elseif($user_password!=$confirmPassword){
      echo "<script>alert('Passwords do not match!')</script>";
    }
    
    else{
       // insert Query.
    move_uploaded_file($user_image_tmp,"adminImages/$user_image"); 
    $insert_query="insert into `admin_table` (admin_name,admin_email,admin_image,admin_password) values ('$user_username',' $user_email','$user_image','$hash_password')";
    $sqlExecute=mysqli_query($con,$insert_query);

}

}

?>