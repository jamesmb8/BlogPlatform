<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}
include "db_connect.php";
$userID = $_SESSION['user_id'];
$dbq = "SELECT User.member_username, User.member_firstname, User.member_lastname
          FROM Friend 
          JOIN User ON Friend.user2_id = User.ID
          WHERE Friend.user1_id = :userID";

$stmt = $db->prepare($dbq);
$stmt->bindValue(':userID', $userID, SQLITE3_INTEGER);
$done = $stmt->execute();
if (!$done) {
    die("Query execution failed: ");
}
$friends = [];
while ($row = $done->fetchArray(SQLITE3_ASSOC)) {
    $friends[] = $row;
}
$db->close();
?>