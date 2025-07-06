<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'bookerma';// Database configuration(same name of the DB as in the SQL file Makeen.sql)
// Create connection
//create Obj from calss mysqli
// mysqli is a class that allows you to connect to a MySQL database
$conn = new mysqli($host, $username, $password, $database);
// Check connection
// if the connection fails, it will return an error message
// if the connection is successful, it will return a success message
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //just to check if the connection is successful
   //echo "Connected successfully";
}
?>