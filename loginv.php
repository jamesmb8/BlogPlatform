<?php
// Establish SQLite connection
$db = new SQLite3('student_module.db');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to retrieve user from the database
    $stmt = $db->prepare('SELECT * FROM members WHERE member_username = :username');
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();

    // Fetch the user row
    $user = $result->fetchArray(SQLITE3_ASSOC);

    // Check if user exists and verify password
    if ($user && password_verify($password, $user['member_password'])) {
        // Authentication successful
        echo "Login successful! Welcome, {$user['member_username']}!";
        // Redirect to dashboard or desired page
        ('Location: dashboard.php');
        exit;
    } else {
        // Authentication failed
        echo "Invalid username or password. Please try again.";
    }
}
?>