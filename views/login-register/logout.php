<?php 
session_start();

$uid = $_SESSION['user_id'] ?? null;

session_destroy();

header("Location: /views/index.php");
exit();
?>