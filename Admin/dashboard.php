<?php
session_start();
include('../Includes/conn.php');
include('functions/functions.php');
// Check for the cookie on every page load. If the cookie exists, the user is logged in.
if (!is_logged_in()) {
  // The user is not logged in, so redirect them to the login page.
  header('Location: index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawaPets Kenya - Find Your Perfect Pet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
      <!-- admin header -->
      <div class="admin-header text-center">
            <?php
            if(!isset($_SESSION['admin_name'])){
              echo"<h3 class='salutation'>Fuck you<span class='text-warning' >Stranger!</span>!</h3>";
            }else{
              echo"<h4 class='salutation'>Welcome <span class='text-warning' >".$_SESSION['admin_name']."</span>!</h4>";
            }
            ?>          
             </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>