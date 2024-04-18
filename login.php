<?php
// Start session
session_start();

// Establish SQLite connection
$db = new SQLite3('StudentModule.db');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement with placeholders for username and password
    $stmt = $db->prepare('SELECT * FROM Users WHERE member_username = :username AND member_password = :password');
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT); // Note: Password is not hashed
    $result = $stmt->execute();

    // Check if user exists with the provided credentials
    $user = $result->fetchArray(SQLITE3_ASSOC);
    if ($user) {
        // Authentication successful
        // Store user information in session variables
        $_SESSION['username'] = $username;

        // Redirect to dashboard or desired page
        header('Location: dashboard.php');
        exit;
    } else {
        // Authentication failed
        echo "Invalid username or password. Please try again.";
    }
} else {
    // Handle non-POST requests (if any)
    echo "Error: This page expects POST requests only.";
}

?>