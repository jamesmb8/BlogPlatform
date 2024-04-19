<?php
session_start();

// Include the getUserPosts function
include "phpfunctions/getusersposts.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header('Location: login.html');
    exit;
}

// Retrieve user ID from session
$userID = $_SESSION['user_id'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];

// Path to your SQLite database file
$dbPath = "StudentModule.db";

// Call getUserPosts to retrieve user posts
$userPosts = getUserPosts($userID, $dbPath);
?>




<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="css/style.css">
   
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
                 <a href="phpfunctions/logout.php"> Log Out</a>
                
            </div>
            
        </div>
        <!----------------- middle content--------- -->
        <div class="main-content">
            <h2>Your posts</h2>
</div>

<?php
// Display user posts
if (!empty($userPosts)) {
    foreach ($userPosts as $post) {
        echo "<div class='post'>";
        echo "<p>Posted by: " . $post['username'] . "</p>";
        echo "<p>Posted on: " . date("F j, Y, g:i a", strtotime($post['post_date'])) . "</p>";
        echo "<p>" . nl2br(htmlspecialchars($post['post_text'])) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No posts found.</p>";
}
?>




    

    <script src="script.js"></script>
</body>

</html>