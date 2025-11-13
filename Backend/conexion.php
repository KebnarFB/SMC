<?php 
$host = "100.113.115.21";
$user = "remote";
$pwd= "";
$db = "smc_db";

$conn = mysqli_connect($host, $user, $pwd, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start(); 
?>