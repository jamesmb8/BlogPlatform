<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.html');
    exit;
}

// Validate and sanitize post_text
if (isset($_POST['post_text']) && !empty($_POST['post_text'])) {
    $post_text = htmlspecialchars($_POST['post_text']);
    $member_ID = $_SESSION['user_id'];
    $currentDateTime = date('Y-m-d H:i:s');

    // Database connection
    $dbPath = "../StudentModule.db";
    $db = new SQLite3($dbPath);

    if (!$db) {
        die("Failed to connect to SQLite database.");
    }

    try {
        // Prepare SQL statement to insert post
        $sql = "INSERT INTO Post (post_text, post_date, member_ID) 
                VALUES (:post_text, :post_date, :member_ID)";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':post_text', $post_text, SQLITE3_TEXT);
        $stmt->bindValue(':post_date', $currentDateTime, SQLITE3_TEXT);
        $stmt->bindValue(':member_ID', $member_ID, SQLITE3_INTEGER);

        // Execute SQL statement
        $result = $stmt->execute();

        if ($result) {
            // Post inserted successfully
            header('Location: ../try2.php');
            exit;
        } else {
            // Error inserting post
            echo "Failed to create post.";
        }
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }

    // Close database connection
    $db->close();
} else {
    echo "Invalid post data.";
}
?>