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

    // Check if insertion was successful
    if ($insertResult) {
        // Close database connection
        $db->close();

        // JavaScript alert for successful addition
        echo "<script>alert('User successfully added as a friend.'); window.location = '../try2.php';</script>";
        exit;
    } else {
        // JavaScript alert for failed to add user
        echo "<script>alert('Failed to add user as a friend. Please try again later.');</script>";
    }
} else {
    // JavaScript alert for user not found
    echo "<script>alert('User not found. Please enter a valid username.');</script>";
}

// Close database connection
$db->close();

// Redirect back to try2.php if any JavaScript alerts were displayed
echo "<script>window.location = '../try2.php';</script>";
?>