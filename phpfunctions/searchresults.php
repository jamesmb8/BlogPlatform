<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

// Specify the path to the database file relative to add_friend.php
$dbPath = "../StudentModule.db"; // Navigate up one level to access the database file

// Establish database connection
$db = new SQLite3($dbPath);

if (!$db) {
    die("Failed to connect to SQLite database.");
}

$userID = $_SESSION['user_id'];
$searchUsername = $_GET['search_username'];

// Query to find user by username
$query = "SELECT ID FROM User WHERE member_username = :searchUsername";
$stmt = $db->prepare($query);
$stmt->bindValue(':searchUsername', $searchUsername, SQLITE3_TEXT);
$result = $stmt->execute();

if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $friendID = $row['ID'];

    // Insert friendship into Friend table (both directions for bidirectional friendship)
    $insertQuery = "INSERT INTO Friend (user1_id, user2_id) VALUES (:userID, :friendID), (:friendID, :userID)";
    $insertStmt = $db->prepare($insertQuery);
    $insertStmt->bindValue(':userID', $userID, SQLITE3_INTEGER);
    $insertStmt->bindValue(':friendID', $friendID, SQLITE3_INTEGER);
    $insertResult = $insertStmt->execute();

    // Close database connection
    $db->close();

    // Redirect back to try2.php after successfully adding a friend
    header("Location: ../try2.php");
    exit;
} else {
    // Close database connection
    $db->close();

    echo "User '$searchUsername' not found.";
    // Optionally, redirect back to try2.php or display an error message
    // header("Location: ../try2.php");
    // exit;
}
?>
