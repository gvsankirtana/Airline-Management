<?php
  session_start();
  if(($_SESSION["user"])==null)
     {
      header("location: login.php");
     }
  $showalert=false;
  $nameErr = $emailErr = $phoneErr= $adherr="";
   include 'connect.php';
   $f=0;
   $s=$_SESSION['seats'];

    for ($i = 1; $i <= $s; $i++)  
    {   
    $name = $_POST["name$i"];
    $email =$_POST["email$i"];
    $phone =$_POST["phone$i"];
    $city =$_POST["city$i"];
    $postal =$_POST["zipcode$i"];
    $adhaar =$_POST["adhaar$i"];
    $_SESSION["adhaar$i"]=$_POST["adhaar$i"];
    $state =$_POST["state$i"];
    $gender =$_POST["gender$i"];
    $dob =$_POST["dob$i"];
    $exists=false;
<<<<<<< HEAD
    $sql2= " SELECT `passadhar`(@p0) AS `passadhar`";
    $res = mysqli_query($conn, $sql2);
    $row=mysqli_fetch_assoc($res);

    //$count=mysqli_num_rows($res);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed" ;
    } 
    else if (!preg_match("/^[0-9\-\(\)\/\+\s]*$/",$phone)) {
      $phoneErr = "Enter Valid Phone number" ;
    } 
    else if($row['passadhar']==0) {
=======
    //$sql2 = "CALL passadhar($adhaar);";
    $sql2="SELECT count(*) FROM passenger_info WHERE Aadhar_No = '$adhaar'";
    $res = mysqli_query($conn, $sql2);
    if ($res){
      $showalert = true;
   }
   else{
   echo("Error description: " . mysqli_error($conn));
   }
    if(mysqli_num_rows($res)<=0) {
        //$sql = "CALL inspass('$adhaar', '$dob','$email','$name','$gender','$phone','$state','$city','$postal')";
>>>>>>> 9ed5da6da84b0daf533c450bbef1565ab14060dc
        $sql = "INSERT INTO `passenger_info` ( `Aadhar_No`, `P_DOB`,`P_email`,`P_Name`,`P_gender`,`p_phone_no`,`state`,`city`,`pincode`) VALUES ('$adhaar', '$dob','$email','$name','$gender','$phone','$state','$city','$postal')";
        $sql1= "CALL ageup('$adhaar');";
        // $sql1= "UPDATE `passenger_info` SET `P_age` = year(CURRENT_DATE())-year(`P_DOB`) where Aadhar_No='$adhaar'";
        $result = mysqli_query($conn, $sql);
        mysqli_query($conn, $sql1);
} 
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Ticket Booking Form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="passenger.css" rel="stylesheet">
</head>
<style>
body {
  font-family: "Lato", sans-serif;
  background-image: url("https://c1.wallpaperflare.com/preview/466/615/643/cappadocia-turkey-travel-hot-air-balloon.jpg");
  background-repeat: no-repeat;
  background-size: cover;
}
.sidenav {
  height: 100%;
  width: 160px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 60px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
  margin-right: 80px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
    html, body {
      min-height: 100%;
      }
      .sidenav {
  height: 100%;
  width: 160px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: transparent;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: BLACK;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}
      body, div, form, input, select, textarea, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: black;
      line-height: 22px;
      }
      h1 {
      position: absolute;
      margin: 0;
      line-height: 55px;
      font-size: 55px;
      color: #fff;
      z-index: 2;
      }
      .testbox {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding: 20px;
      }
      form {
      width: 100%;
      padding: 20px;
      border-radius: 6px;
      background: #fff;
      box-shadow: 0 0 30px 0 #a37547; 
      }
      .banner {
      position: relative;
      height: 230px;
      background-image: url("https://c1.wallpaperflare.com/preview/466/615/643/cappadocia-turkey-travel-hot-air-balloon.jpg");  
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      }
      .banner::after {
      content: "";
      background-color: rgba(0, 0, 0, 0.4); 
      position: absolute;
      width: 100%;
      height: 100%;
      }
      input, select, textarea {
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      }
      input {
      width: calc(100% - 10px);
      padding: 5px;
      }
      select {
      width: 100%;
      padding: 7px 0;
      background: transparent;
      }
      textarea {
      width: calc(100% - 12px);
      padding: 5px;
      }
      .item:hover p, .item:hover i, .question:hover p, .question label:hover, input:hover::placeholder {
      color: #a37547;
      }
      .item input:hover, .item select:hover, .item textarea:hover {
      border: 1px solid transparent;
      box-shadow: 0 0 6px 0 #a37547;
      color: #a37547;
      }
      .item {
      position: relative;
      margin: 10px 0;
      }
      input[type=radio], input[type=checkbox]  {
      display: none;
      }
      label.radio {
      position: relative;
      display: inline-block;
      margin: 5px 20px 15px 0;
      cursor: pointer;
      }
      .question span {
      margin-left: 30px;
      }
      label.radio:before {
      content: "";
      position: absolute;
      left: 0;
      width: 17px;
      height: 17px;
      border-radius: 50%;
      border: 2px solid #ccc;
      }
      input[type=radio]:checked + label:before, label.radio:hover:before {
      border: 2px solid #a37547;
      }
      label.radio:after {
      content: "";
      position: absolute;
      top: 6px;
      left: 5px;
      width: 8px;
      height: 4px;
      border: 3px solid #a37547;
      border-top: none;
      border-right: none;
      transform: rotate(-45deg);
      opacity: 0;
      }
      input[type=radio]:checked + label:after {
      opacity: 1;
      }
      .btn-block {
      margin-top: 10px;
      text-align: center;
      }
      button {
      width: 150px;
      padding: 10px;
      border: none;
      border-radius: 5px; 
      background: #6b4724;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      }
      button:hover {
      box-shadow: 0 0 18px 0 #3d2914;
      }
      @media (min-width: 568px) {
      .name-item, .city-item {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      }
      .name-item input, .city-item input {
      width: calc(50% - 20px);
      }
      .city-item select {
      width: calc(50% - 8px);
      }
      }
      #side a, .dropdown-btn {
   padding: 6px 8px 6px 16px;
   text-decoration: none;
   font-size: 20px;
   color: white;
   display: block;
   border: none;
   background: none;
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
li {list-style-type: none;
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
#navbar {
   overflow: hidden;
   background-color:rgba(0,0,0,0.5);
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
<div class="main">
      <nav id="side">
        <ul>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <li><a href="profile.php">Profile</a></li>
          <li><a href="searchflights.php">Book Ticket</a></li>
          <li><a href="enquiry.php">Enquiry</a></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;logout</a></li>
        </ul>
      </nav>
      <img style="top: 120px;right:30px;" src="https://cdn1.iconfinder.com/data/icons/mobile-device/512/settings-option-configurate-gear-blue-round-512.png" style="width: 70px;"id="menu">
      <div class="alert alert-success" role="alert">
            <center><p>You have successfuly entered your Information!</p></center>
            <br>
            <center><p> Click below button for payment👇</p></center>
            <br>
            <div class="btn-block">
            <button type="submit"><a href="payment.php" class="button">Payment</a></button>
           </div>
            <hr>
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