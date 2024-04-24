<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

include "db_connect.php";

$userID = $_SESSION['user_id'];

$dbq = "
    SELECT post_text, post_date, member_username
    FROM Post
    INNER JOIN User ON Post.member_ID = User.ID
    WHERE Post.member_ID = :userID OR Post.member_ID IN (
        SELECT user2_id FROM Friend WHERE user1_id = :userID
    )
    ORDER BY post_date DESC
";
$done = $db->prepare($dbq);
$done->bindValue(':userID', $userID, SQLITE3_INTEGER);
$done->execute();
$posts = [];
while ($row = $done->fetchArray(SQLITE3_ASSOC)) {
    $posts[] = $row;
}
$db->close();
echo json_encode($posts);
?>