<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
$created = false;
include "db_connect.php";

$userID = $_SESSION['user_id'];
$searchUsername = $_GET['search_username'];

$dbq = "SELECT ID FROM User WHERE member_username = :searchUsername";
$done = $db->prepare($dbq);
$done->bindValue(':searchUsername', $searchUsername, SQLITE3_TEXT);
$done->execute();

if ($row = $done->fetchArray(SQLITE3_ASSOC)) {
    $friendID = $row['ID'];

    $dbq2 = "INSERT INTO Friend (user1_id, user2_id) VALUES (:userID, :friendID), (:friendID, :userID)";
    $statememnt = $db->prepare($dbq2);
    $statement->bindValue(':userID', $userID, SQLITE3_INTEGER);
    $statement->bindValue(':friendID', $friendID, SQLITE3_INTEGER);
    $statement->execute();

    if ($statement) {
        $created = true;
        $db->close();
        echo "<script>alert('User successfully added as a friend.'); window.location = '../mainpage.php';</script>";
        exit;
    } else {
       
        echo "<script>alert('Failed to add user as a friend. Please try again later.');</script>";
    }
} else {
    
    echo "<script>alert('User not found. Please enter a valid username.');</script>";
}


$db->close();
?>