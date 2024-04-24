<?php
session_start();
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $phone = $_POST['phone'];

    
    if (empty($username) || empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($phone)) {
       
        header("Location: signup.html?error=Please fill in all required fields");
        exit;
    }

    $dbq = "INSERT INTO User (member_username, member_firstname, member_lastname, member_email, member_password, member_phone)
              VALUES (:username, :firstname, :lastname, :email, :password, :phone)";

    $done = $db->prepare($dbq);
    $done->bindValue(':username', $username, SQLITE3_TEXT);
    $done->bindValue(':firstname', $firstname, SQLITE3_TEXT);
    $done->bindValue(':lastname', $lastname, SQLITE3_TEXT);
    $done->bindValue(':email', $email, SQLITE3_TEXT);
    $done->bindValue(':password', $password, SQLITE3_TEXT);
    $done->bindValue(':phone', $phone, SQLITE3_TEXT);

    $done->execute();

    if ($done) {
      
        $userID = "SELECT ID
                        FROM User
                        Where member_username = :username";

       
        $_SESSION['user_id'] = $userID;
        $_SESSION['username'] = $username;
        $_SESSION['first_name'] = $firstname;
        $_SESSION['last_name'] = $lastname;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;

        
        header("Location: ../mainpage.php");
        exit;
    } else {
        
        header("Location: signup.html?error=Failed to register user") . $db->lastErrorMsg();
        exit;
    }

   
    $db->close();
} else {
   
    header("Location: signup.html");
    exit;
}
?>