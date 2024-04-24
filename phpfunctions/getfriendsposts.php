<?php

function getFriendsPosts($userID, $mydb)
{
    $friendsPosts = [];
    $db = new SQLite3($mydb);
    if (!$db) {
        die("Failed to connect to SQLite database.");
    }
    $dbq = "
        SELECT Post.post_text, Post.post_date, User.member_username
        FROM Post 
        JOIN User ON Post.member_ID = User.ID
        WHERE Post.member_ID IN (
            SELECT user2_id
            FROM Friend
            WHERE user1_id = :userID
        )
        ORDER BY Post.post_date DESC
    ";

    $stmt = $db->prepare($dbq);
    $stmt->bindValue(':userID', $userID, SQLITE3_INTEGER);
    $done = $stmt->execute();
    if ($done) {
        while ($row = $done->fetchArray(SQLITE3_ASSOC)) {
            $friendsPosts[] = [
                'post_text' => $row['post_text'],
                'post_date' => $row['post_date'],
                'username' => $row['member_username']
        ];
    }
    }


    $db->close();

    return $friendsPosts;
}
?>