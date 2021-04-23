<?php
session_start();
require 'connect.php';

$flightid=$_SESSION['flightid'];
$class=$_SESSION['class'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $BankName=mysqli_real_escape_string($conn,$_POST["BankName"]);
    $AccountNumber=mysqli_real_escape_string($conn,$_POST["AccountNumber"]);
    $query = "INSERT INTO ticket (class, payment_Type, booking_time, booking_date, account_No, Bank_name, flight_ID) values('$class', 'UPI', CURRENT_TIME(), CURRENT_DATE(), '$AccountNumber', '$BankName', '$flightid')";
    $result = mysqli_query($conn, $query);
    header ("location: searchflights.php");
}
?>