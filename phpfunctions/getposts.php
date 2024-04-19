<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

// Specify the path to the database file relative to fetch_posts.php
$dbPath = "../StudentModule.db"; // Path to SQLite database file

// Establish database connection
$db = new SQLite3($dbPath);

if (!$db) {
    die("Failed to connect to SQLite database.");
}

// Get current user's ID from session
$userID = $_SESSION['user_id'];

// Query to fetch posts for current user and their friends
$query = "
    SELECT post_text, post_date, member_username
    FROM Post
    INNER JOIN User ON Post.member_ID = User.ID
    WHERE Post.member_ID = :userID OR Post.member_ID IN (
        SELECT user2_id FROM Friend WHERE user1_id = :userID
    )
    ORDER BY post_date DESC
";
$stmt = $db->prepare($query);
$stmt->bindValue(':userID', $userID, SQLITE3_INTEGER);
$result = $stmt->execute();

// Array to store fetched posts
$posts = [];

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $posts[] = $row;
}

// Close database connection
$db->close();

// Return posts as JSON data
echo json_encode($posts);
?>