<?php
$con=mysqli_connect("localhost", "root", "", "airport_management") or die(mysqli_error($con));
session_start();
$username=mysqli_real_escape_string($con,$_POST["login_username"]);
$password=mysqli_real_escape_string($con,$_POST["password"]);
$query = "SELECT * FROM airport_management.login WHERE login_username='$username' and password='$password'";
$result = mysqli_query($con, $query);
$count=mysqli_num_rows($result);
if($count==0){
    echo "User account does not exists.";
}
else{
    header("location: searchflights.html");
}
?>