<?php

function make_connection()

{
$db = new SQLite3('C:/Applications/XAMPP/xamppfiles/htdocs/newprojsoftware/data/Databasemain.db');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Databasemain";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}


return $conn;

}

?>