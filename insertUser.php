<?php
//This file name is insertUser.php
//This is the function name
function createUser()
{

    //This 4 are variable assignments
    $created = false;//this variable is used to indicate the creation is successfull or not
    $db = new SQLite3('StudentModule.db'); // db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
    $sql = 'INSERT INTO User( member_username, member_firstName, member_lastName, member_password, member_email, member_phone) VALUES (:userName, :fName, :lName, :pwd, :email, :Phone)';
    $stmt = $db->prepare($sql); //prepare the sql statement

    //give the values for the parameters
    //we use SQLITE3_TEXT for text/varchar. You can use SQLITE3_INTEGER or SQLITE3_REAL for numerical values
    $stmt->bindParam(':userName', $_POST['uname'], SQLITE3_TEXT);
    $stmt->bindParam(':fName', $_POST['fname'], SQLITE3_TEXT);
    $stmt->bindParam(':lName', $_POST['lname'], SQLITE3_TEXT);
    $stmt->bindParam(':pwd', $_POST['pwd'], SQLITE3_TEXT);
    $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);
    $stmt->bindParam(':Phone', $_POST['Phone'], SQLITE3_TEXT);

    //execute the sql statement
    $stmt->execute();

    //the logic
    if ($stmt) {
        $created = true;
    }

    return $created;
}