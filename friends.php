<?php

session_start();


if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {

    header('Location: login.html');
    exit;
}


$user_id = $_SESSION['ID'];
$username = $_SESSION['username'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];


require_once "phpfunctions/getfriends.php";

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

    </div>
<div class="container">
        <div class="left-sidebar">
            <div class="imp-links">
                 <a href="try2.php"><img src="images/home.png"> Home</a>
                 <a href="account.php"><img src="images/User-image.png"> Account</a>

                
            </div>
            
        </div>
        <!----------------- middle content--------- -->
        <div class="main-content">
            <h2>Search for friends</h2>
            <form action="phpfunctions/searchresults.php" method="GET" id="searchform">
    <label for="search_username">Search for username:</label>
    <input type="text" id="search_username" name="search_username" required>
    <button type="submit">Add Friend</button>
</form>

  <h2>Your friends</h2>
<div id="friends.list">
<?php

if (!empty($friends)) {
    echo '<ul>';
    foreach ($friends as $friend) {
        echo '<li>';
        echo 'Username: ' . htmlspecialchars($friend['member_username']) . '<br>';
        echo 'First Name: ' . htmlspecialchars($friend['member_firstname']) . '<br>';
        echo 'Last Name: ' . htmlspecialchars($friend['member_lastname']);
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo 'You have no friends yet.';
}
?>
</div>
</div>


    


</body>

</html>