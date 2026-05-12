<?php
// For Local
$host = "localhost";
$username = "root";
$password = "";
$database = "ticketsystem";

// For Online
// $host = "sql202.yzz.me";
// $username = "yzzme_41900988";
// $password = "L7kZuJRcmgeY";
// $database = "yzzme_41900988_ticketsystem";
 
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 
?>