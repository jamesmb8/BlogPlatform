<?php
session_start();

$dbPath = "../StudentModule.db";
$db = new SQLite3($dbPath);

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
    $currentDateTime = date('Y-m-d H:i:s');

    var_dump($_POST);

    try {
  
        $sql = "INSERT INTO Post (post_text, post_date, member_ID) 
                VALUES (:post_text, :post_date, :member_ID)";

        $stmt = $db->prepare($sql);

     
        $stmt->bindValue(':post_text', $post_text, SQLITE3_TEXT);
        $stmt->bindValue(':post_date', $currentDateTime, SQLITE3_TEXT);
        $stmt->bindValue(':member_ID', $member_ID, SQLITE3_INTEGER);

       
        $result = $stmt->execute();

        if ($result) {

            header('Location: ../try2.php');
            exit;
        } else {
   
            echo "Failed to create post: " . $db->lastErrorMsg();
        }
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }

 
    $db->close();
} else {
    echo "Invalid post data.";
}
?>