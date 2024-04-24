<?php
// Enable error reporting and display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Function to retrieve user posts by user ID
function getUserPosts($userID, $dbPath)
{
    // Initialize an empty array for user posts
    $userPosts = [];

    // Database connection
    $db = new SQLite3($dbPath);

    if (!$db) {
        die("Failed to connect to SQLite database.");
    }

    // SQL query to fetch posts with user information
    $query = "
        SELECT p.post_text, p.post_date, u.member_username
        FROM Post p
        JOIN User u ON p.member_ID = u.ID
        WHERE p.member_ID = :userID
        ORDER BY p.post_date DESC
    ";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':userID', $userID, SQLITE3_INTEGER);
    $result = $stmt->execute();

    // Process query results and populate the $userPosts array
    if ($result) {
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $userPosts[] = [
                'post_text' => $row['post_text'],
                'post_date' => $row['post_date'],
                'username' => $row['member_username']
            ];
        }
    }

    // Close database connection
    $db->close();

    return $userPosts;
}
?>