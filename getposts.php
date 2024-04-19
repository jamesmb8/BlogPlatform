<?php
// Retrieve user ID from session
$userID = $_SESSION['user_id'];

// Query to fetch user's posts in descending order
$query = "SELECT * FROM Post WHERE member_ID = :userID ORDER BY created_at DESC";
$stmt = $db->prepare($query);
$stmt->bindValue(':userID', $userID, SQLITE3_INTEGER);
$result = $stmt->execute();

// Display user's posts
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $postText = $row['post_text'];
    $createdAt = $row['created_at'];

    // Display each post
    echo "<div class='post'>";
    echo "<p>Posted on: " . date("F j, Y, g:i a", strtotime($createdAt)) . "</p>";
    echo "</div>";
}
?>