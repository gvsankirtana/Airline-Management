<?php
session_start();
require 'connect.php';

$flightid=$_SESSION['flightid'];
$class=$_SESSION['class'];
$aadhar=$_SESSION['adhaar'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $BankName=mysqli_real_escape_string($conn,$_POST["BankName"]);
    $AccountNumber=mysqli_real_escape_string($conn,$_POST["AccountNumber"]);
    $query = "INSERT INTO ticket (class, payment_Type, booking_time, booking_date, account_No, Bank_name, flight_ID, aadhar_no) values('$class', 'UPI', CURRENT_TIME(), CURRENT_DATE(), '$AccountNumber', '$BankName', '$flightid', '$aadhar')";
    $result = mysqli_query($conn, $query); 
    $query = "UPDATE airline SET vacant_seats=(SELECT vacant_seats FROM airline WHERE Flight_ID = '$flightid')-1 WHERE Flight_ID = '$flightid'";
    $result = mysqli_query($conn, $query);
    echo $query;
    echo $result;
    header ("location: searchflights.php");
}
?>