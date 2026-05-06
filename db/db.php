<?php
$username = "root";
$password = "";
$database = "ticketsystem";
 
$conn = mysqli_connect("localhost", $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 
?>