<?php

function getUserPosts($userID, $dbPath)
{
    $userPosts = [];
    $db = new SQLite3($dbPath);
    if (!$db) {
        die("Failed to connect to SQLite database.");
    }
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
    if ($result) {
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $userPosts[] = [
                'post_text' => $row['post_text'],
                'post_date' => $row['post_date'],
                'username' => $row['member_username']
    ];
    }
    }
    $db->close();
    return $userPosts;
}
?>