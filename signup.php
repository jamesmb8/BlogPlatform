<?php
// Start session (if needed)
session_start();

// Validate form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data using $_POST
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Note: In a real application, hash the password securely.
    $phone = $_POST['phone'];

    // Validate input (basic validation for demonstration purposes)
    if (empty($username) || empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($phone)) {
        // Redirect back to signup page with error message
        header("Location: signup.html?error=Please fill in all required fields");
        exit;
    }

    // Database connection using SQLite3
    $dbFile = "StudentModule.db"; 
    $db = new SQLite3($dbFile);

    if (!$db) {
        die("Failed to connect to SQLite database.");
    }

    // Prepare INSERT statement to add new user to User table
    $query = "INSERT INTO User (member_username, member_firstname, member_lastname, member_email, member_password, member_phone)
              VALUES (:username, :firstname, :lastname, :email, :password, :phone)";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':firstname', $firstname, SQLITE3_TEXT);
    $stmt->bindValue(':lastname', $lastname, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);
    $stmt->bindValue(':phone', $phone, SQLITE3_TEXT);

    $result = $stmt->execute();

    if ($result) {
        // Registration successful, redirect to login page or dashboard
        header("Location: try2.php"); 
        exit;
    } else {
        // Redirect back to signup page with error message
        header("Location: signup.html?error=Failed to register user");
        exit;
    }

    // Close database connection
    $db->close();
} else {
    // Redirect back to signup page if accessed directly without POST request
    header("Location: signup.html");
    exit;
}
?>