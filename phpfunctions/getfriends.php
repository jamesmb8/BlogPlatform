<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

// Database connection
include "db_connect.php";

// Get user ID from session
$userID = $_SESSION['user_id'];

// Query to fetch user's friends
$query = "SELECT U.member_username, U.member_firstname, U.member_lastname
          FROM Friend F
          JOIN User U ON F.user2_id = U.ID
          WHERE F.user1_id = :userID";



$stmt = $db->prepare($query);
$stmt->bindValue(':userID', $userID, SQLITE3_INTEGER);



$result = $stmt->execute();
if (!$result) {
    die("Query execution failed: ");
}

// Array to store friends' information
$friends = [];

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $friends[] = $row;
}

// Close database connection
$db->close();

// Output friends' information as JSON (for AJAX requests, if needed)

?>