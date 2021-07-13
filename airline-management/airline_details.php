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
    $sql3="SELECT * FROM airline WHERE Flight_ID = '$fid'";
    $res = mysqli_query($conn, $sql3);                                                                                                                                                                                                                                                                
    $exists=false;
    if(mysqli_num_rows($res)==0){
        $sql =  "INSERT INTO `airline` (`Flight_ID`,`Reference_no`,`economy_Fare`,`buisness_fare`,`vacant_seats`,`dept_Time`,`dept_date`,`departure_Destination`,`arrival_time`,`arrival_date`,`arrival_destination`) VALUES ('$fid','$refno','$efare','$bfare','$vacant','$deptime','$depdate','$depcity','$arrtime','$arrdate',' $arrcity')";
        $sql1 = "INSERT INTO `reference_flight_no` ( `Reference_no`,`Flight_Type`,`Airline_name`) VALUES ('$refno', '$ftype','$fname')";
        $sql2 = "INSERT INTO `manages`(`Login_username`, `Flight_ID`)VALUES('$user','$fid')";
        //echo "here";
        $result = mysqli_query($conn, $sql);
        $result1 = mysqli_query($conn, $sql1);
        $result2 = mysqli_query($conn, $sql2);
        echo $result;
        if ($result){                                                
            $showalert = true;
         }
         else{
         echo("Error description: " . mysqli_error($conn));
         }
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
		</div>
	</div>
<div class="main">
<nav id="side">
      <ul>
        <br><br><br><br><br><br><br><br>
        <li><a href="admin_profile.php">Profile</a></li>
        <li style="top: 24px;"><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;logout</a></li>
      </ul>
    </nav>
    <img src="https://cdn1.iconfinder.com/data/icons/mobile-device/512/settings-option-configurate-gear-blue-round-512.png" style="width: 70px; top: 120px"id="menu">
<?php if($showalert){
    echo `<div class="alert alert-success" role="alert">
     <center><p>You have successfuly entered your Information!</p></center>
     <hr>
     </div>`;
}?>
    <div class="testbox">
    <form action="/flight_management/airline_details.php" method="post">
      <div class="banner">
        <h1>  Airline Details Entry</h1>
      </div>
      <br>
      <div class="item">
      <p>*If you have already filled your details then check your <a href="profile.php">profile</a>*</p>
      <br>
        <p>Flight ID </p>
          <input type="text" id="fid" name="fid" required/>
      </div>
      <div class="item">
        <p>Flight Type</p>
          <select name="ftype" required>
          <option value="Domestic">Domestic</option>
          <option value="International">International</option>
          </select>
        </div>
      <div class="item">
        <p>Airline Name</p>
          <input type="text" name="fname" required/>
        </div>
      <div class="item">
        <p>Reference_no</p>
        <input type="text" name="refno" required/>
        </div>
        <div class="item">
        <p>Economy Fare</p>
        <input type="text" name="efare" placeholder='$' required/>
        </div>
        <div class="item">
        <p>Buisness Fare</p>
        <input type="text" name="bfare" placeholder='$' required/>
        </div>
        <div class="item">
        <p>vacant Seats</p>
        <input type="number" name="vacant" required />
        </div>
        <div class="item">
        <p>Departure Destination</p>
          <select name="depcity" required>
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
          <input type="date" name="depdate" min="2021-04-27" required/>
        </div>
        <p>Departure Time</p>
        <div class="day-visited">
        <input type="time" id="deptime" name="deptime" required>
        </div>
        <div class="item">
        <p>Arrival Destination</p>
          <select name="arrcity" required>
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
          <input type="date" name="arrdate" required/>
        </div>
        <p>Arrival Time</p>
        <div class="day-visited">
        <input type="time" id="arrtime" name="arrtime" min="2021-04-28" required>
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
