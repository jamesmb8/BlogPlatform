<?php
session_start();
$dbFile = "../StudentModule.db";
$db = new SQLite3($dbFile);

if (!$db) {
    die("Failed to connect to SQLite database.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];


    $query = "SELECT * FROM User WHERE member_username = :username AND member_password = :password";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);
    $result = $stmt->execute();


    $user = $result->fetchArray(SQLITE3_ASSOC);
    if ($user) {
        $_SESSION['user_id'] = $user['ID'];
        $_SESSION['username'] = $user['member_username'];
        $_SESSION['first_name'] = $user['member_firstname'];
        $_SESSION['last_name'] = $user['member_lastname'];
        $_SESSION['email'] = $user['member_email'];
        $_SESSION['phone'] = $user['member_phone'];
        $_SESSION['password'] = $user['member_password'];

        header("Location: ../try2.php");
        exit();
    } else {
        echo "Invalid username or password. Please try again.";
    }
}
$db->close();
?>