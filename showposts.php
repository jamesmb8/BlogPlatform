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

// Path to your SQLite database file
$dbPath = "StudentModule.db";

// Call getUserPosts to retrieve user posts
$userPosts = getUserPosts($userID, $dbPath);
?>
<!DOCTYPE html>
<html>

<head>
    <title>User Account</title>
     <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Welcome to Your Account</h1>

    <h2>Your Posts:</h2>
    <div id="userPosts">
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
    </div>

</body>

</html>