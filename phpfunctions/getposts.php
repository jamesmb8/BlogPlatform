<?php
session_start();

// Include database connection
$dbPath = "../StudentModule.db"; // Path to SQLite database file
$db = new SQLite3($dbPath);

// Check if database connection is successful
if (!$db) {
    die("Failed to connect to database: " . $db->lastErrorMsg());
}

// Retrieve user ID from session
$userID = $_SESSION['user_id'];

// Query to fetch posts from the current user and their friends
$query = "
    SELECT p.post_text, p.post_date, u.member_username
    FROM Post p
    JOIN User u ON p.member_ID = u.ID
    WHERE p.member_ID = :userID OR p.member_ID IN (
        SELECT user2_id
        FROM Friend
        WHERE user1_id = :userID
    )
    ORDER BY p.post_date DESC
";

$stmt = $db->prepare($query);
$stmt->bindValue(':userID', $userID, SQLITE3_INTEGER);
$result = $stmt->execute();

// Display user's and friends' posts
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $postText = $row['post_text'];
    $postDate = $row['post_date'];
    $username = $row['member_username'];

    // Display each post
    echo "<div class='post'>";
    echo "<p>Posted by $username on: " . date("F j, Y, g:i a", strtotime($postDate)) . "</p>";
    echo "<p>" . nl2br(htmlspecialchars($postText)) . "</p>"; // Display post text (escape HTML)
    echo "</div>";
}

// Close database connection
$db->close();
?>
