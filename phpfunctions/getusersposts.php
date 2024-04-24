<?php

function getUserPosts($userID, $mydb)
{
    $created = false;
    $db = new SQLite3($mydb);

    if (!$db) {
        die("Failed to connect to SQLite database.");
    }
    $dbq = "
        SELECT Post.post_text, Post.post_date, User.member_username
        FROM Post 
        JOIN User ON Post.member_ID = User.ID
        WHERE Post.member_ID = :userID
        ORDER BY Post.post_date DESC
    ";

    $stmt = $db->prepare($dbq);
    $stmt->bindValue(':userID', $userID, SQLITE3_INTEGER);
    $done = $stmt->execute();
    $userPosts = [];

    if ($done) {
        $created = true;
        while ($row = $done->fetchArray(SQLITE3_ASSOC)) {
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