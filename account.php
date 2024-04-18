
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
$user_id = $_SESSION['ID'];
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
    <title>Account</title>
    <link rel="stylesheet" href="style.css">
   
</head>

<body>

   <?php include 'navbar.php'; ?>

    <!-- ----profile page --------- -->

    <div class="profile-container">
       
        <div class="profile-details">
            <div class="pd-left">
                <div class="pd-row">
                    
                    <div>
                       
                        <ul>
                <li>First Name: <?php echo $_SESSION['first_name']; ?></li>
                 <li>Last name: <?php echo $_SESSION['last_name']; ?></li>
                 <li>Username: <?php echo $_SESSION['username']; ?></li>
                 <li>E-Mail: <?php echo $_SESSION['email']; ?></li>
                  <li>Phone: <?php echo $_SESSION['phone']; ?></li>
                   <li>Password: <?php echo $_SESSION['password']; ?></li>
               
</ul>
                       
                    </div>
                </div>
            </div>
           
        </div>

        

    </div>
<div class="container">
        <div class="left-sidebar">
            <div class="imp-links">
                 <a href="try2.php"><img src="images/User-image.png"> Home</a>
                 <a href="friends.php"><img src="images/friends.png"> Friends</a>
                 <a href="logout.php"> Log Out</a>
                
            </div>
            
        </div>
        <!----------------- middle content--------- -->
        <div class="main-content">
            <h2>Your posts</h2>
</div>





    

    <script src="script.js"></script>
</body>

</html>