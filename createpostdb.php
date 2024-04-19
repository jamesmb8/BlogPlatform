<?php
// Start session (if not already started)
session_start();

// Check if user is logged in (validate session)
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.html");
    exit;
}

// Validate form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data using $_POST
    $postText = $_POST['post_text'];
    $userID = $_SESSION['user_id']; // Retrieve user ID from session

    // Database connection using SQLite3
    $dbFile = "StudentModule.db"; // Update with your database file path
    $db = new SQLite3($dbFile);

    if (!$db) {
        die("Failed to connect to SQLite database.");
    }

    // Prepare INSERT statement to add new post to Post table
    $query = "INSERT INTO Post (post_text, member_ID) VALUES (:post_text, :userID)";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':post_text', $postText, SQLITE3_TEXT);
    $stmt->bindValue(':userID', $userID, SQLITE3_INTEGER);

    $result = $stmt->execute();

    if ($result) {
        // Post insertion successful, redirect to try2.php or another page
        header("Location: try2.php");
        exit;
    } else {
        // Redirect back to createpost.php with error message
        header("Location: createpost.php?error=Failed to create post");
        exit;
    }

    // Close database connection
    $db->close();
} else {
    // Redirect back to createpost.php if accessed directly without POST request
    header("Location: createpost.php");
    exit;
}
?>
