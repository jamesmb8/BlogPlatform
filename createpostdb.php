<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header('Location: login.html');
    exit;
}

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Validate and sanitize post text
if (isset($_POST['post_text'])) {
    $post_text = $_POST['post_text'];

    // SQLite3 database connection
    $dbFile = "StudentModule.db";
    $db = new SQLite3($dbFile);

    if (!$db) {
        die("Failed to connect to SQLite database.");
    }

    // Prepare and execute INSERT query to save the post
    $query = "INSERT INTO Post (member_ID, post_text) VALUES (:user_id, :post_text)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
    $stmt->bindValue(':post_text', $post_text, SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
        // Post created successfully, redirect to try2.php
        header('Location: try2.php');
        exit;
    } else {
        echo "Error creating post.";
    }

    $db->close();
} else {
    echo "Post text not provided.";
}
?>