<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
session_start();
require 'connect.php';
$BankName=mysqli_real_escape_string($conn,$_POST["BankName"]);
$AccountNumber=mysqli_real_escape_string($conn,$_POST["AccountNumber"]);
$flightid=12546;
$class="Business";
$aadhar=$_SESSION['adhaar'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $query = "INSERT INTO ticket (Booking_Ref, class, payment_Type, booking_time, booking_date, account_No, Bank_name, flight_ID, aadhar_no) values('$class', 'UPI', CURRENT_TIME(), CURRENT_DATE(), '$AccountNumber', '$BankName', '$flightid', '$aadhar')";
    $result = mysqli_query($conn, $query);
    $query = "SELECT Ticket_no FROM ticket WHERE aadhar_no='$aadhar'";
    $result =mysqli_query($conn,$query);
    echo "#".$flightid;
    $query = "UPDATE airline SET vacant_seats=(SELECT vacant_seats FROM airline WHERE Flight_ID = '$flightid')-1 WHERE Flight_ID = '$flightid'";
    $result = mysqli_query($conn, $query);
    header ("location: searchflights.php");
}
?>