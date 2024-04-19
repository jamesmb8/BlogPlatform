<?php
session_start();

// Validate user session
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user ID and post text from form data
    $userID = $_SESSION['user_id'];
    $postText = $_POST['post_text'];

    // Include database connection
    $dbPath = "../StudentModule.db"; // Path to SQLite database file
    $db = new SQLite3($dbPath);

    // Check if database connection is successful
    if (!$db) {
        die("Failed to connect to database: " . $db->lastErrorMsg());
    }

    // Get current date and time in ISO 8601 format
    $currentDateTime = date('Y-m-d H:i:s');

    // Insert post into database with current timestamp
    $insertQuery = "INSERT INTO Post (member_ID, post_text, post_date) VALUES (:userID, :postText, :currentDateTime)";
    $stmt = $db->prepare($insertQuery);
    $stmt->bindValue(':userID', $userID, SQLITE3_INTEGER);
    $stmt->bindValue(':postText', $postText, SQLITE3_TEXT);
    $stmt->bindValue(':currentDateTime', $currentDateTime, SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
        // Post created successfully, redirect to try2.php
        header("Location: ../try2.php");
        exit;
    } else {
        // Failed to insert post, display error message
        header("Location: ../createpost.php?error=Failed%20to%20create%20post");
        exit;
    }
}
?>