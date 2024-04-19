<?php
session_start();

// Include database connection
require_once "path/to/connection.php"; // Adjust path as needed

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

// Retrieve user ID from session
$userID = $_SESSION['user_id'];

// Query to fetch posts from the current user and their friends
$query = "
    SELECT p.post_text, p.created_at, u.member_username
    FROM Post p
    JOIN User u ON p.member_ID = u.ID
    WHERE p.member_ID = :userID OR p.member_ID IN (
        SELECT user2_id FROM Friend WHERE user1_id = :userID
    )
    ORDER BY p.created_at DESC
";

$stmt = $db->prepare($query);
$stmt->bindValue(':userID', $userID, SQLITE3_INTEGER);
$result = $stmt->execute();

// Display user's and friends' posts
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $postText = $row['post_text'];
    $createdAt = $row['created_at'];
    $username = $row['member_username'];

    // Display each post
    echo "<div class='post'>";
    echo "<p>Posted by $username on: " . date("F j, Y, g:i a", strtotime($createdAt)) . "</p>";
    echo "<p>" . nl2br(htmlspecialchars($postText)) . "</p>"; // Display post text (escape HTML)
    echo "</div>";
}

// Close database connection
$db->close();
?>
