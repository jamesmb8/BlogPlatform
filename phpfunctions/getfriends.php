<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
}

include "db_connect.php";
$userID = $_SESSION['user_id'];
$dbq = "SELECT U.member_username, U.member_firstname, U.member_lastname
    FROM Friend F
          JOIN User U ON F.user2_id = U.ID
          WHERE F.user1_id = :userID";
$done = $db->prepare($dbq);
$done->bindValue(':userID', $userID, SQLITE3_INTEGER);
$done->execute();
if (!$done) {
    die("Query execution failed: ");
}

$friends = [];
while ($row = $done->fetchArray(SQLITE3_ASSOC)) {
    $friends[] = $row;
}
$db->close();

?>