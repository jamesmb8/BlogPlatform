<?php
function getFriendsPosts($userID, $mydb)
{
    $friendsPosts = [];

    include "db_connect.php";
    $dbq = "
        SELECT p.post_text, p.post_date, u.member_username
        FROM Post p
        JOIN User u ON p.member_ID = u.ID
        WHERE p.member_ID IN (
            SELECT user2_id
            FROM Friend
            WHERE user1_id = :userID
        )
        ORDER BY p.post_date DESC
    ";

    $done = $db->prepare($dbq);
    $done->bindValue(':userID', $userID, SQLITE3_INTEGER);
    $done->execute();
        while ($row = $done->fetchArray(SQLITE3_ASSOC)) {
            $friendsPosts[] = [
                'post_text' => $row['post_text'],
                'post_date' => $row['post_date'],
                'username' => $row['member_username']
    ];
    }

    $db->close();

    return $friendsPosts;
}
?>