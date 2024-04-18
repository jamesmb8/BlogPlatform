<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // User is not logged in, redirect to login page
    header('Location: login.html');
    exit;
}

// If logged in, you can access user information from session variables
$username = $_SESSION['username'];

// Display dashboard content here (authenticated user)
echo "Welcome, $username! This is your dashboard (try2.php).";
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialBook - Easy Tutorials YouTube Channel</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
</head>

<body>

        <?php include 'navbar.php'; ?>
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <div class="container">
        <div class="left-sidebar">
            <div class="imp-links">
                
                <a href="account.php"><img src="images/User-image.png"> Account</a>
                 <a href="friends.php"><img src="images/friends.png"> Friends</a>
            </div>
            
        </div>
        <!----------------- middle content--------- -->
        <div class="main-content">
            <h2>Posts</h2>
</div>
<?php include 'makepostbtn.php'; ?>

     

    <script src="script.js"></script>
</body>

</html>