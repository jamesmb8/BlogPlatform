<?php
session_start();
include "db_connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dbq = "SELECT * FROM User WHERE member_username = :username AND member_password = :password";
    $done = $db->prepare($dbq);
    $done->bindValue(':username', $username, SQLITE3_TEXT);
    $done->bindValue(':password', $password, SQLITE3_TEXT);
    $done->execute();

    $user = $done->fetchArray(SQLITE3_ASSOC);
    if ($user) {
      
        $_SESSION['user_id'] = $user['ID'];
        $_SESSION['username'] = $user['member_username'];
        $_SESSION['first_name'] = $user['member_firstname'];
        $_SESSION['last_name'] = $user['member_lastname'];
        $_SESSION['email'] = $user['member_email'];
        $_SESSION['phone'] = $user['member_phone'];
        $_SESSION['password'] = $user['member_password'];

        // Redirect to mainpage.php upon successful login
        header("Location: ../mainpage.php");
        exit();
    } else {
        // Display error message if credentials are incorrect
        echo "Invalid username or password. Please try again.";
    }
}
$db->close();
?>