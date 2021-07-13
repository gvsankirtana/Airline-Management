<?php 
 session_start();
 if(($_SESSION["user"])==null)
	{
	 header("location: login.php");
	} 
include 'connect.php';
$user=$_SESSION["user"];  
$sql3="SELECT * FROM enquiry WHERE enquiry_answer IS NULL";
$res=mysqli_query($conn,$sql3);
if ($res){
  }
  else
  echo("Error description: " . mysqli_error($conn));
$f=1;
echo 
'
<table border=10 class="table table-bordered table-hover" id="tab_logic" align="center"  style="font-size:15px;background-color: black;">
<thead>
<tr><th colspan="13"><h3>FAQS</h3></th></tr>
<tr>
      <th scope="col">Enquiry ID</th>
	  <th scope="col">Enquiry Title</th>
	  <th scope="col">Enquiry Type</th>
	  <th scope="col">Enquiry Description</th>
	</tr>
  </thead>
  ' ;
  while($rows=mysqli_fetch_assoc($res))
  {
	echo "<tr><td>{$rows['Enquiry_ID']}</td>;
	 <td>{$rows['Enquiry_title']}</td>
	 <td>{$rows['Enquiry_type']}</td> 
	 <td>{$rows['Enquiry_Description']}</td><tr>";
  }
echo '</table>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Customer Enquiry</title>
   <style>
	   * {
	box-sizing: border-box;
}
body {
	font-family: poppins;
	font-size: 16px;
	color: #fff;
}
.form-box {
	background-color: rgba(0, 0, 0, 0.5);
	margin: auto auto;
	padding: 40px;
	border-radius: 5px;
	box-shadow: 0 0 10px #000;
	position: absolute;
	top: 0;
	bottom: 0;
	left: 200px;
	right: 0;
	width: 500px;
	height: 430px;
}
.form-box:before {
	background-image: url("https://image.freepik.com/free-vector/customer-care-illustration-concept_42694-26.jpg");
	width: 100%;
	height: 100%;
	background-size: cover;
	content: "";
	position: fixed;
	left: 0;
	right: 0;
	top: 0;
	bottom: 0;
	z-index: -1;
	display: block;
	filter: blur(2px);
}
#tab_logic{
	background-color: rgba(0, 0, 0, 0.5);
	margin: auto auto;
	padding: 40px;
	border-radius: 5px;
	box-shadow: 0 0 10px #000;
	position: absolute;
	top: 100px;
	bottom: 0;
	left: 0;
	right: 1000px;
	width: 300px;
	height: 430px;
}
.form-box .header-text {
	font-size: 32px;
	font-weight: 600;
	padding-bottom: 30px;
	text-align: center;
}
.form-box input {
	margin: 10px 0px;
	border: none;
	padding: 10px;
	border-radius: 5px;
	width: 100%;
	font-size: 18px;
	font-family: poppins;
}
.form-box textarea {
	margin: 10px 0px;
	border: none;
	padding: 10px;
	border-radius: 5px;
	width: 100%;
	font-size: 18px;
	font-family: poppins;
}
.form-box input[type=checkbox] {
	display: none;
}
.form-box label {
	position: relative;
	margin-left: 5px;
	margin-right: 10px;
	top: 5px;
	display: inline-block;
	width: 20px;
	height: 20px;
	cursor: pointer;
}
.form-box label:before {
	content: "";
	display: inline-block;
	width: 20px;
	height: 20px;
	border-radius: 5px;
	position: absolute;
	left: 0;
	bottom: 1px;
	background-color: #ddd;
}
.form-box input[type=checkbox]:checked+label:before {
	content: "\2713";
	font-size: 20px;
	color: #000;
	text-align: center;
	line-height: 20px;
}
.form-box span {
	font-size: 14px;
}
.form-box button {
	background-color: deepskyblue;
	color: #fff;
	border: none;
	border-radius: 5px;
	cursor: pointer;
	width: 100%;
	font-size: 18px;
	padding: 10px;
	margin: 20px 0px;
}
span a {
	color: #BBB;
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
   </style>
</head>
<body>
	<div id="navbar">
		<img src="https://5.imimg.com/data5/TK/AD/MY-36130657/flight-booking-500x500.png" class="img-fluid" width="200" height="100" style="float:left">
	</div>
	<nav id="side">
      <ul>
        <br><br><br><br><br><br><br><br>
        <li><a href="admin_profile.php">Profile</a></li>
        <li style="top: 24px;"><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;logout</a></li>
      </ul>
    </nav>
    <img src="https://cdn1.iconfinder.com/data/icons/mobile-device/512/settings-option-configurate-gear-blue-round-512.png" style="width: 70px; top: 120px"id="menu">
	<?php
   $showalert=false;
   $userErr = $enquiErr = $ansErr="";
   if($_SERVER["REQUEST_METHOD"] == "POST")
    { 
    include 'connect.php';
	$emp = $_POST["emp"];
    $enquiid = $_POST["enqui"];
    $ans =$_POST["ans"];
    $exists=false;
    if (empty($_POST["enqui"])) {
      $enquiErr = "Enter Enquiry ID" ;
    } 
	else if(empty($_POST["ans"])){
		$ansErr = "Enter answer" ;
	}
    else{
        $sql="INSERT INTO `answers`(`Enquiry_ID`,`login_username`) values ('$enquiid',$user)";
        $sql1="UPDATE `enquiry` SET `enquiry_answer`= '$ans' WHERE `Enquiry_ID` = '$enquiid'" ;
        mysqli_query($conn, $sql);
        $result = mysqli_query($conn, $sql1);
        if ($result){
           $showalert = true;
        }
        else
        echo("Error description: " . mysqli_error($conn));
    }
}
?>
	<div class="form-box">
	<?php
if($showalert){
echo '  <div class="alert alert-success" role="alert" style="color:white">
<p>You have successfuly entered your enquiry!</p>
<hr>
</div> ';
}
?>
        <form action=http://localhost/flight_management/empenquiryanswer.php method="POST">
		<div class="header-text">
			Answering Query 
		</div><input placeholder="Enquiry id" name="enqui" id="enqui" type="type"><textarea  name="ans" id="ans" rows="4" cols="50">Enter answer for query</textarea> <button>Submit</button>
        </form>
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
		var scroll = new SmoothScroll('a[href*="#"]');
		window.onscroll = function() {myFunction()};
		var navbar = document.getElementById("navbar");
		var sticky = navbar.offsetTop;
		function myFunction() {
		if (window.pageYOffset >= sticky) {
					navbar.classList.add("sticky")
		}
		 else {
		navbar.classList.remove("sticky");
		}
		}
		</script>
</body>
</html>
