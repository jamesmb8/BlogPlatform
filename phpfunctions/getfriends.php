<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}
include "db_connect.php";
$userID = $_SESSION['user_id'];
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
$friends = [];
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $friends[] = $row;
}
$db->close();
?>