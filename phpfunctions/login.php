<?php
session_start();

// SQLite3 database connection
$dbFile = "../StudentModule.db";
$db = new SQLite3($dbFile);

if (!$db) {
    die("Failed to connect to SQLite database.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database for the user
    $query = "SELECT * FROM User WHERE member_username = :username AND member_password = :password";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);
    $result = $stmt->execute();

    // Check if the user exists and credentials are correct
    $user = $result->fetchArray(SQLITE3_ASSOC);
    if ($user) {
        // Start a session and store user information
        $_SESSION['user_id'] = $user['ID'];
        $_SESSION['username'] = $user['member_username'];
        $_SESSION['first_name'] = $user['member_firstname'];
        $_SESSION['last_name'] = $user['member_lastname'];
        $_SESSION['email'] = $user['member_email'];
        $_SESSION['phone'] = $user['member_phone'];
        $_SESSION['password'] = $user['member_password'];

        // Redirect to try2.php upon successful login
        header("Location: ../try2.php");
        exit();
    } else {
        // Display error message if credentials are incorrect
        echo "Invalid username or password. Please try again.";
    }
}
?>