<?php
// logout.php
include("functions/functions.php");

logout_user();
header("Location: index.php");
exit;
?>