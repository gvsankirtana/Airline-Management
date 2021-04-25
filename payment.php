<?php
  /*session_start();
  if(($_SESSION["user"])==null)
     {
      header("location: login.php");
     }
     header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
     $s=$_SESSION['seats'];
     $flightid=$_SESSION["flightid"];
  include 'connect.php';

  if($_SERVER["REQUEST_METHOD"] == "POST")
{
for ($i = 1; $i <= $s; $i++)  
  {
    $adhaar =$_POST["adhaar$i"]; 
    echo $adhaar;*/
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
session_start();
if(($_SESSION["user"])==null){
  header("location: login.php");
}
$s=$_SESSION['seats'];
$flightid=$_SESSION["flightid"];
include 'connect.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $BankName=mysqli_real_escape_string($conn,$_POST["BankName"]);
  $AccountNumber=mysqli_real_escape_string($conn,$_POST["AccountNumber"]);
  $cancel=mysqli_real_escape_string($conn,$_POST["button"]);
  if($cancel=="cancel"){
    header("location: cancelticket.php");
  }
  $s=$_SESSION['seats'];
  $flightid=$_SESSION['flightid'];
  $bank=0;
  $accountn=0;
  if($BankName==null){
    $bank=1;
  }
  if($AccountNumber==null){
    $accountn=1;
  }
  if($bank==0 && $accountn==0){
    $adetails=mysqli_real_escape_string($conn,$_POST["adetails"]);
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
  header('location: searchflights.php');  
  }
     
  
}
$class="Business";
  if($class=="Business"){
    $price = "SELECT buisness_fare from airline where Flight_ID='$flightid'";
    //echo $price;
  }
  else if($class==$_SESSION['class']){
    $price="SELECT economy_Fare from airline where Flight_ID='$flightid'";
  }
  $query ="SELECT Flight_ID, departure_Destination, arrival_destination from airline where Flight_ID='$flightid'";
  $result1=mysqli_query($conn, $price);
  $result = mysqli_query($conn, $query);
  $pricerow=mysqli_fetch_row($result1);
  $row = mysqli_fetch_row($result);

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
    <style>
      body{
        background-image: url("images/payment.jpg");
        background-repeat: no-repeat;
        background-position: center;
        background-size:cover,contain;
      }
      #navbar {
        overflow: hidden;
        background-color:rgba(0,0,0,0.2);
        text-align: right;
      }
      #navbar a {
        float: right;
        display: block;
        color: white;
        text-align: right;
        padding: 30px 30px;
        text-decoration: none;
        font-size: 17px;
      }
      #navbar a:hover {
        background-color: #ddd;
        color: white;
      }
      #navbar a.active {
        background-color: black;
        color: white;
      }
      #side a, .dropdown-btn {
        padding: 6px 8px 6px 0px;
        text-decoration: none;
        font-size: 20px;
        color: white;
        display: block;
        border: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        outline: none;
      }
      #side a:hover, .dropdown-btn:hover {
        color: yellow;
      }
      .sticky {
        position: fixed;
        top: 0;
        width: 100%;
      }
      .sticky + .content {
        padding-top: 60px;
      }
      #menu{
        width:50px;
        position: fixed;
        right: 65px;
        top:35px;
        z-index:2;
        cursor:pointer;
      }
      #side{
        width:250px;
        height:700px;
        position: fixed;
        right:-250px;
        top:0;
        background-color:rgba(0,0,0,0.2);
        z-index: 2;
        transition: 2s;
        overflow-y: scroll;
      }
      li {
        list-style-type: none;
        font-size: 16pt;
      }
      nav ul li{
        list-style: none;
        margin:50px 20px;
      }
      nav ul li a{
        text-transform: uppercase;
        text-decoration: none;
        color: white;
        text-align: right;
      }
      .main {
        margin-left: 60px; /* Same as the width of the sidenav */
        font-size: 28px; /* Increased text to enable scrolling */
        padding: 0px 10px;
        margin-right: 80px;
      }
      .headingstyle{
        background-image: url("images/payment.jpg");
        background-repeat: no-repeat;
        background-position: center;
        background-size:cover,contain;
        color: white;
      }
    </style>
  </head>
  <body>
    <div id="navbar">
      <div class="container">
        <img src="https://5.imimg.com/data5/TK/AD/MY-36130657/flight-booking-500x500.png" class="img-fluid" width="171.2" height="100" style="float:left">
        <ul class="nav navbar-nav navbar-right">
      <li style="top: 24px;"><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php print_r($_SESSION["user"]);?></a></li>
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
    <br><br><br>
    <div class="row container">
      <div class="col-xs-8 container">
        <div class="container-fluid" style="padding-right: 50px; padding-left: 50px;">
        <form action="payment.php" method="POST">
            
          <div class="panel" style="left: 34px;">
            <div class="panel-heading headingstyle">
              <h2><b>Payment Details</b></h2>
            </div>
            <div class="panel-body">
              <div class="form-group">
                <label for="Bank_Name">Bank Name</label> <br>
                <select class="form-control" aria-label="slect bank" name="BankName">
                  <option selected value=""> </option>
                  <option value="sbi">SBI</option>
                  <option value="hdfc">HDFC</option>
                  <option value="icici">ICICI</option>
                  <option value="axis">Axis</option>
                  <option value="kotak">Kotak</option>
                </select>
              </div>
              <div class="form-group">
                <label for="Account_Number">Account Number</label> <br>
                <input type="text" class="form-control" name="AccountNumber">
              </div>
              <div class="form-select">
                <input type="checkbox" value="save" name="adetails">
                <label for="adetails">Save account details</label>
              </div>
              <div class="alert alert-danger" role="alert"  style="margin-top: 20px; margin-bottom: 0px; border:0px; padding:0px;">
              <?php
              if($_SERVER["REQUEST_METHOD"] == "POST"){
                if($bank==1){
                  echo'
                    <p style={color:red;}>Select Bank</p>
                  ';
                }
                if($accountn==1){
                  echo'
                    <p style={color:red;}>Enter Account Number</p>
                  ';
                }
              }
              ?>
              </div>
              
            </div>
            <div class="panel-footer text-right" style="align-items:center;">
              <button class="btn btn-info" value="submit" name="button">Submit</button>
              <button class="btn btn-info" value="cancel" name="button" href="cancelticket.php">Cancel</button>
            </div>
          </div>
          </form>
        </div>
      </div>
      <div class="col-xs-4 container">
        <div class="container-fluid panel-margin">
        <br>
          <div class="panel">
          <div class="panel-heading headingstyle">
          <h3><b>Billing Details</b></h3>
          </div>
          <div class="panel-body">
          <table class="table table-hover">
            <tr>
              <th>Flight Number</th>
              <td><?php echo $flightid?></td>
            </tr>
            <tr>
              <th>From</th>
              <td>
              <?php 
                echo $row[0];
              ?></td>
            </tr>
            <tr>
              <th>To</th>
              <td><?php echo $row[1] ?> </td>
            </tr>
            <tr>
              <th>Charges</th>
              <td><?php echo "₹";echo ($pricerow[0])*($_SESSION['seats']) ?></td>
            </tr>
          </table>
          </div>
          </div>
        </div>
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