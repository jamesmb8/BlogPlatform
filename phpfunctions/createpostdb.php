<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header('Location: login.html');
    exit;
}

// Get user ID from session
$member_ID = $_SESSION['user_id'];

// Validate and sanitize post_text
if (isset($_POST['post_text'])) {
    $post_text = htmlspecialchars($_POST['post_text']);

    // Get current date and time in SQLite datetime format
    $currentDateTime = date("Y-m-d H:i:s"); // Example: 2024-04-18 15:30:00

    // Database connection
    $dbPath = "../StudentModule.db"; // Path to SQLite database file
    $db = new SQLite3($dbPath);

    if (!$db) {
        die("Failed to connect to SQLite database.");
    }

    // Prepare SQL statement to insert post
    $sql = "INSERT INTO Post (post_text, post_date, member_ID) 
            VALUES (:post_text, :post_date, :member_ID)";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':post_text', $post_text, SQLITE3_TEXT);
    $stmt->bindValue(':post_date', $currentDateTime, SQLITE3_TEXT); // Use text type for SQLite datetime
    $stmt->bindValue(':member_ID', $member_ID, SQLITE3_INTEGER);

    // Execute SQL statement
    $result = $stmt->execute();

    if ($result) {
        // Post inserted successfully
        header('Location: ../try2.php'); // Redirect to try2.php after successful post
        exit;
    } else {
        // Error inserting post
        echo "Failed to create post.";
    }

    // Close database connection
    $db->close();
} else {
    // Redirect or handle invalid form submission
    echo "Invalid form submission.";
}
?>