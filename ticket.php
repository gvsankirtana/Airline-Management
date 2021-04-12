<?php
require 'connect.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $BankName=mysqli_real_escape_string($conn,$_POST["BankName"]);
    $AccountNumber=mysqli_real_escape_string($conn,$_POST["AccountNumber"]);
    $query = "INSERT INTO ticket WHERE login_username='$username' and password='$password'";
    $result = mysqli_query($conn, $query);
}
?>