<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
session_start();
require 'connect.php';
$user=$_SESSION["user"]; 
$BankName=mysqli_real_escape_string($conn,$_POST["BankName"]);
$AccountNumber=mysqli_real_escape_string($conn,$_POST["AccountNumber"]);
$adetails=mysqli_real_escape_string($conn,$_POST["adetails"]);
$button=mysqli_real_escape_string($conn,$_POST["button"]);
$s=$_SESSION['seats'];
$flightid=$_SESSION['flightid'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($button=="cancel"){
        header("location: cancelticket.php");
    }
    else{
      $query="insert into booking(login_username, Flight_ID) values('$user', '$flightid')";
      $result = mysqli_query($conn, $query);
    if($adetails=="save"){
        for ($i = 1; $i <= $s; $i++){
            $adhaar =$_SESSION["adhaar$i"]; 
            $bookref= $flightid."#".$adhaar;
            $query = "INSERT INTO ticket (aadhar_no,Booking_Ref,class, payment_Type, booking_time, booking_date, account_No, Bank_name, flight_ID) values('$adhaar','$bookref','Economy', 'UPI', CURRENT_TIME(), CURRENT_DATE(), '$AccountNumber', '$BankName', '$flightid')";
            $result = mysqli_query($conn, $query);
            }  
    }
    else{
        for ($i = 1; $i <= $s; $i++){
            $adhaar =$_SESSION["adhaar$i"]; 
            $bookref= $flightid."#".$adhaar;
            $query = "INSERT INTO ticket (aadhar_no,Booking_Ref,class, payment_Type, booking_time, booking_date, flight_ID) values('$adhaar','$bookref','Economy', 'UPI', CURRENT_TIME(), CURRENT_DATE(),'$flightid')";
            $result = mysqli_query($conn, $query);
        }  
    }     
    $query = "UPDATE airline SET vacant_seats=(SELECT vacant_seats FROM airline WHERE Flight_ID = '$flightid')-$s WHERE Flight_ID = '$flightid'";
    $result = mysqli_query($conn, $query);
    }
}
?>
<!DOCTYPE html>
<html>
  <title>Payment Page</title>
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="ticket.css">
  </head>
  <body>
    <div id="navbar">
      <div class="container">
        <img src="https://5.imimg.com/data5/TK/AD/MY-36130657/flight-booking-500x500.png" class="img-fluid" width="171.2" height="100" style="float:left">
        <ul class="nav navbar-nav navbar-right">
      <li style="top: 24px;"><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php print_r($user);?></a></li>
			</ul>
      </div>
    </div>
    <nav id="side">
    <ul>
        <br><br><br><br><br><br><br><br>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="searchflights.php">Book Ticket</a></li>
        <li><a href="enquiry.php">Enquiry</a></li>
        <li style="top: 24px;"><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;logout</a></li>
      </ul>
    </nav>
    <img style="top: 120px;" src="https://cdn1.iconfinder.com/data/icons/mobile-device/512/settings-option-configurate-gear-blue-round-512.png" style="width: 70px;"id="menu">    
    <div class="container text-center flex-container" style="vertical-position:center;">
    <div>
    <div style="color:white; font-size:64px;"><b>THANK YOU!</b></div>
    <div style="color:white; font-size:17px;">Your booking has been confirmed...<br><a href="searchflights.php"style="color:yellow;">click to continue booking flights!</a></div>
    </div>
    </div>
    <script>
      var menu=document.getElementById("menu");
      var side=document.getElementById("side");
      side.style.right="-250px";
      menu.onclick=function(){
      if(side.style.right=="-250px"){
        side.style.right="0px"
      }
      else{
        side.style.right="-250px"
        }
      }
      </script> 
  </body>  
</html>