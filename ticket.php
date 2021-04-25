<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
session_start();
require 'connect.php';
$BankName=mysqli_real_escape_string($conn,$_POST["BankName"]);
$AccountNumber=mysqli_real_escape_string($conn,$_POST["AccountNumber"]);
$s=$_SESSION['seats'];
$flightid=$_SESSION['flightid'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    for ($i = 1; $i <= $s; $i++){
    $adhaar =$_SESSION["adhaar$i"]; 
    $bookref= $flightid."#".$adhaar;
    $query = "INSERT INTO ticket (aadhar_no,Booking_Ref,class, payment_Type, booking_time, booking_date, account_No, Bank_name, flight_ID) values('$adhaar','$bookref','Economy', 'UPI', CURRENT_TIME(), CURRENT_DATE(), '$AccountNumber', '$BankName', '$flightid')";
    $result = mysqli_query($conn, $query);
    echo $query." ".$result."<br>";
    }    
    $query = "UPDATE airline SET vacant_seats=(SELECT vacant_seats FROM airline WHERE Flight_ID = '$flightid')-$s WHERE Flight_ID = '$flightid'";
    $result = mysqli_query($conn, $query);
    header('location: searchflights.php');
}
?>