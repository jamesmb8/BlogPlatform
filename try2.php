<?php
// Start session
session_start();


// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // User is not logged in, redirect to login page
    header('Location: login.html');
    exit;
}
require_once"db_connect.php";

// If logged in, retrieve user information from session variables
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];

?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialBook - Easy Tutorials YouTube Channel</title>
    <link rel="stylesheet" href="css/style.css">
   
</head>

<body>

        <?php include 'navbar.php'; ?>
       
    <div class="container">
        <div class="left-sidebar">
            <div class="imp-links">
                
                <a href="account.php"><img src="images/User-image.png"> Account</a>
                 <a href="friends.php"><img src="images/friends.png"> Friends</a>
            </div>
            
        </div>
        <!----------------- middle content--------- -->
        <div class="main-content">
            <h2>Your Posts, <?php echo $_SESSION['first_name']; ?></h2>
          
</div>
<?php include "getposts.php"; ?>







 <?php include 'makepostbtn.php'; ?>

     

    <script src="script.js"></script>
</body>

</html>