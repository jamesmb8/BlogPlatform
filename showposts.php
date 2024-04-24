<?php
session_start();

include "phpfunctions/getusersposts.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

$userID = $_SESSION['user_id'];


include"phpfunctions/db_connect.php";


$userPosts = getUserPosts($userID, $mydb);
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
        <div class="post">
        <?php
    
        if (!empty($userPosts)) {
            foreach ($userPosts as $post) {
                echo "<p>Posted by: " . $post['username'] . "</p>";
                echo "<p>Posted on: " . date("F j, Y, g:i a", strtotime($post['post_date'])) . "</p>";
                echo "<p>" . nl2br(htmlspecialchars($post['post_text'])) . "</p>";
            }
        } else {
            echo "<p>No posts found.</p>";
        }
        ?>
    </div>
 </div>
</body>

</html>