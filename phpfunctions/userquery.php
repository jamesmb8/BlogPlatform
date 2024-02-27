<?php

include_once("db_conn.php");
function createuser($first_name,$last_name, $password, $email, $phonenumber)
{

    $conn = make_connection();

    $stmt = $conn->prepare("INSERT INTO Member (member_name, member_lastname, member_email, member_password, member_phone) VALUES (?, ?, ?, ?, ?");
    $stmt->bind_param('sssss',$first_name, $last_name, $email, $password, $phone_number);



}
?>

