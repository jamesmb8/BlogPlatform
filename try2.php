<?php

session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {

    header('Location: login.html');
    exit;
}
require_once "phpfunctions/db_connect.php";




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
    <title>Home Page</title>
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
            <h2>Your home screen, <?php echo $_SESSION['first_name']; ?></h2>




            <?php
            $userID = $_SESSION['user_id'];
            $dbPath = "StudentModule.db";
            include "phpfunctions/getusersposts.php";
            include "phpfunctions/getfriendsposts.php";

            $userPosts = getUserPosts($userID, $dbPath);


            $friendsPosts = getFriendsPosts($userID, $dbPath);


            $allPosts = array_merge($userPosts, $friendsPosts);

            usort($allPosts, function ($a, $b) {
                return strtotime($b['post_date']) - strtotime($a['post_date']);
            });

      
            foreach ($allPosts as $post) {
                echo '<div class="post">';
                echo '<p>' . htmlspecialchars($post['post_text']) . '</p>';
                echo '<p>Posted by: ' . htmlspecialchars($post['username']) . '</p>';
                echo '<p>Posted on: ' . htmlspecialchars($post['post_date']) . '</p>';
                echo '</div>';
            }
            ?>

        </div>
    </div>


    <div class="btm-navbar">
        <a href="createpost.php" class="active">Make a new post</a>

    </div>




</body>

</html>