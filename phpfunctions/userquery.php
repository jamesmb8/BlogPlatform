<?php
function createuser()
{

    //$conn = make_connection();

    $created = false;//this variable is used to indicate the creation is successfull or not
   
    $db = new SQLite3('data/Databasemain.db');// db connection - get your db file here. Its strongly advised to place your db file outside htdocs. 
    $sql = 'INSERT INTO Member( member_name, member_lastname, member_username, member_password, member_email, member_phone ) VALUES (:first_name, :last_Name, :user_name, :password, :email, :phonenumber)';
    $stmt = $db->prepare($sql); //prepare the sql statement

    //give the values for the parameters
 //we use SQLITE3_TEXT for text/varchar. You can use SQLITE3_INTEGER or SQLITE3_REAL for numerical values
    $stmt->bindParam(':first_name', $_POST['first_name'], SQLITE3_TEXT); 
    $stmt->bindParam(':last_name', $_POST['last_name'], SQLITE3_TEXT);
    $stmt->bindParam(':user_name', $_POST['user_name'], SQLITE3_TEXT);
    $stmt->bindParam(':phonenumber', $_POST['phonenumber'], SQLITE3_TEXT);
    $stmt->bindParam(':email', $_POST['email'], SQLITE3_TEXT);
    $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);
    //execute the sql statement
    $stmt->execute();

    //the logic
    if($stmt){
        $created = true;
    }

    return $created;
}

function getUsers()
{

    $db = new SQLITE3('data/Databasemain.db');
    $sql = "SELECT * FROM Member";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    while ($row = $result->fetchArray()) { // use fetchArray(SQLITE3_NUM) - another approach    
        $arrayResult[] = $row; //adding a record until end of records    
    }

    return $arrayResult;

}

?>