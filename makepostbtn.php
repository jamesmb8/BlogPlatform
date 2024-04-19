<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
  // User is not logged in, redirect to login page
  header('Location: login.html');
  exit;
}

// If logged in, retrieve user information from session variables
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/cgcss.css">
</head>
<body>
    <div class="btm-navbar">
  <a href="createpost.php" class="active">Make a new post</a>
  
</div>
</body>
</html>