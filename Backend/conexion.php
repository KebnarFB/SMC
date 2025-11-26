<?php 
$host = "127.0.0.1";
$user = "root";
$pwd= "";
$db = "smc_db";

$conn = mysqli_connect($host, $user, $pwd, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start(); 
?>