<?php
  session_start();
  if(($_SESSION["user"])==null)
     {
      header("location: login.php");
     }
  $showalert=false;
   include 'connect.php';
   $f=0;
   if($_SERVER["REQUEST_METHOD"] == "POST")
    { 
    $fid = $_POST["fid"];
    $ftype =$_POST["ftype"];
    $fname =$_POST["fname"];
    $refno =$_POST["refno"];
    $efare =$_POST["efare"];
    $bfare =$_POST["bfare"];
    $vacant =$_POST["vacant"];
    $depdate =$_POST["depdate"];
    $deptime =$_POST["deptime"];
    $arrdate =$_POST["arrdate"];
    $arrtime =$_POST["arrtime"];
    $depcity =$_POST["depcity"];
    $arrcity =$_POST["arrcity"];  
    $user=$_SESSION["user"];                                                                                                                                                                                                                                                                      
    $exists=false;
        $sql =  "INSERT INTO `airline` ( `Flight_ID`,`Reference_no`,`economy_Fare`,`buisness_fare`,`vacant_seats`,`dept_Time`,`dept_date`,`departure_Destination`,`arrival_time`,`arrival_date`,`arrival_destination`) VALUES ('$fid', '$ftype','$fname','$refno','$efare','$bfare','$vacant','$deptime','$depdate','$depcity','$arrtime','$arrdate',' $arrcity')";
        $sql1 = "INSERT INTO `reference_flight_no` ( `Reference_no`,`Flight_Type`,`Airline_name`) VALUES ('$refno', '$ftype','$fname')";
        $sql2 = "INSERT INTO `manages`(`login_username`,`flight_id`)VALUES('$user','$fid')";
        $result = mysqli_query($conn, $sql);
       // echo $result;
        if ($result){                                                
            $showalert = true;
         }
         else{
         echo("Error description: " . mysqli_error($conn));
         }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Airline Details Entry</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="airline.css" rel="stylesheet">

</head>
<body>
<div id="navbar">
		<div class="container">
			<img src="https://5.imimg.com/data5/TK/AD/MY-36130657/flight-booking-500x500.png" class="img-fluid" width="171.2" height="100" style="float:left">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;LOGOUT</a></li>
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
          <li><a href="searchflights.php">Book Ticket</a></li>
          <li><a href="enquiry.php">Enquiry</a></li>
          <li><a href="admin_profile.php">Profile</a></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;LOGOUT</a></li>
        </ul>
      </nav>
      <img style="top: 120px;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTB5nWJeJStVSln4FEFOjNFF-AWjHE7OhgvYTu4mXG9xQdekA34VR3RXu0o7PJn3EEEJjo&usqp=CAU" style="width: 50px;"id="menu">
    <?php if($showalert){
    echo `<div class="alert alert-success" role="alert">
     <center><p>You have successfuly entered your Information!</p></center>
     <hr>
     </div>`;
}?>
<div class="main">
    <div class="testbox">
    <li style="top: 24px;"><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;LOGOUT</a></li>

    <form action="airline_details.php" method="post">
      <div class="banner">
        <h1>  Airline Details Entry</h1>
      </div>
      <br>
      <div class="item">
        <p>Flight ID </p>
          <input type="text" id="fid" name="fid"/>
      </div>
      <div class="item">
        <p>Flight Type</p>
          <select name="ftype" >
          <option value="Domestic">Domestic</option>
          <option value="International">International</option>
          </select>
        </div>
      <div class="item">
        <p>Airline Name</p>
          <input type="text" name="fname" />
        </div>
      <div class="item">
        <p>Reference_no</p>
        <input type="text" name="refno" />
        </div>
        <div class="item">
        <p>Economy Fare</p>
        <input type="text" name="efare" placeholder='$' />
        </div>
        <div class="item">
        <p>Buisness Fare</p>
        <input type="text" name="bfare" placeholder='$' />
        </div>
        <div class="item">
        <p>vacant Seats</p>
        <input type="number" name="vacant" />
        </div>
        <div class="item">
        <p>Departure Destination</p>
          <select name="depcity" >
          <option value="Hyderabad">Hyderabad</option>
            <option value="Delhi">Delhi </option>
            <option value="Shimla">Shimla</option>
            <option value="Chennai">Chennai</option>
            <option value="Lucknow">Lucknow </option>
            <option value="Allahabad">Allahabad</option>
            <option value="Bengaluru">Bengaluru</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Thiruvananthapuram">Thiruvananthapuram</option>
            <option value="Kolkata">Kolkata </option>
            <option value="Jaipur">	Jaipur</option>
            <option value="Surat">Surat</option>
          </select>
        </div>
        <p>Departure Date</p>
        <div class="day-visited">
        <input class="from_date" placeholder="Select start date" type="text" name="from_date">
          <input type="date" name="depdate" min="2021-04-26" />
        </div>
        <p>Departure Time</p>
        <div class="day-visited">
        <input type="time" id="deptime" name="deptime">
        </div>
        <div class="item">
        <p>Arrival Destination</p>
          <select name="arrcity" >
          <option value="Delhi">Delhi </option>
          <option value="Hyderabad">Hyderabad</option>
            <option value="Shimla">Shimla</option>
            <option value="Chennai">Chennai</option>
            <option value="Lucknow">Lucknow </option>
            <option value="Allahabad">Allahabad</option>
            <option value="Bengaluru">Bengaluru</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Thiruvananthapuram">Thiruvananthapuram</option>
            <option value="Kolkata">Kolkata </option>
            <option value="Jaipur">	Jaipur</option>
            <option value="Surat">Surat</option>
          </select>
          </select>
        </div>
        <p>Arrival Date</p>
        <div class="day-visited">
          <input type="date" name="arrdate" min="2021-04-25"/>
        </div>
        <p>Arrival Time</p>
        <div class="day-visited">
        <input type="time" id="arrtime" name="arrtime" >
        </div>
        <br>
        <div class="btn-block">
          <button type="submit">Add flight</button>
        </div>
      </div>
    </form>
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
