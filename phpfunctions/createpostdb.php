<?php
session_start();
include "db_connect.php";
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}
if (isset($_POST['post_text']) && !empty($_POST['post_text'])) {
    $post_text = htmlspecialchars($_POST['post_text']);
    $member_ID = $_SESSION['user_id'];
    $currentDateTime = date('Y-m-d H:i:s');

    $dbq = "INSERT INTO Post (post_text, post_date, member_ID) 
                VALUES (:post_text, :post_date, :member_ID)";
    $done = $db->prepare($dbq);
    $done->bindValue(':post_text', $post_text, SQLITE3_TEXT);
    $done->bindValue(':post_date', $currentDateTime, SQLITE3_TEXT);
    $done->bindValue(':member_ID', $member_ID, SQLITE3_INTEGER);
    $done->execute();
    if ($done) {

        header('Location: ../mainpage.php');
        exit;
    } else {
        echo "Failed to create post";
    }

    $db->close();
} else {
    echo "Failed to create post.";
}
?>