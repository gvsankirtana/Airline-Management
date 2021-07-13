<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "flight_management";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    echo "fail:";
    die("Error". mysqli_connect_error());
 }
?>