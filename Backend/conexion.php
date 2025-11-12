<?php 
$host = "100.113.115.21";
$user = "remote";
$pwd= "";
$db = "smc";

$conn = mysqli_connect($host, $user, $pwd, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>