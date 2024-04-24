<?php
session_start();

$mydb = "../StudentModule.db";
$db = new SQLite3($mydb);

if (!$db) {
    die("Failed to connect to SQLite database.");
}
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}
if (isset($_POST['post_text']) && !empty($_POST['post_text'])) {
    $post_text = htmlspecialchars($_POST['post_text']);
    $member_ID = $_SESSION['user_id'];
    $currentDate = date('Y-m-d H:i:s');

    $sql = "INSERT INTO Post (post_text, post_date, member_ID) 
                VALUES (:post_text, :post_date, :member_ID)";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':post_text', $post_text, SQLITE3_TEXT);
    $stmt->bindValue(':post_date', $currentDate, SQLITE3_TEXT);
    $stmt->bindValue(':member_ID', $member_ID, SQLITE3_INTEGER);
    $done = $stmt->execute();

    if ($done) {

        header('Location: ../try2.php');
        exit;
    } else {

        echo "Failed to create post: ";
    }

    $db->close();
} else {
    echo "Invalid post data.";
}
?>