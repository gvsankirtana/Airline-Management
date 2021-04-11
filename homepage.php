<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#myModal").modal('show');
		});
	</script>
	<style>		
form {
    display: inline-block;
    box-sizing: content-box;
    box-shadow: 2px 2px 20px 5px black;
    padding: 10px;
    width:100%;
    max-width: 400px;
}
#b{
  text-align:center;
}
input {
    box-shadow: 1px 1px 3px 1px black;
    width: 100%;
    text-align: center; 
}
.submit,.reset {
    display:inline-block;
    color: white;
    background-color: blue;

    margin:0;
    padding: 5px;
    border: 0;
    font-weight: bold;
    width:100%;
}
.submit:hover ,.reset:hover{
    color: blue;
    background-color: red;
    font-size: 0.7em;
    font-weight: bold;
}
*{
   margin:0;
   padding:0;
   
}
body{
   background-image: url("https://monroeaerospace.com/blog/wp-content/uploads/2019/08/airplane-landing-lights-874x452.jpg");
   background-repeat: no-repeat;
   background-size:cover;
}
li {list-style-type: none;
   font-size: 16pt;
}
.mail {
   margin: auto;
   padding-top: 10px;
   padding-bottom: 10px;
   width: 400px;
   background : black;
   border: 1px soild silver;
}
.mail h2 {
   margin-left: 38px;
}
input {
   font-size: 20pt;
}
input submit {
   font-size: 12pt;
}
#main{
   margin-right: 50px;
   margin-left: 50px;
}
.header-text{
   max-width: 340px;
   margin-top: 170px;
   margin-left: 100px;
   margin-bottom: 100px;
   text-shadow: 3px 2px black;
}
h1{
   font-size:40px ;
   color:white;
}
.header-text button{
   margin-top: 20px;
   margin-bottom: 60px;
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
a:hover{
   background-color:gray;
}
#menu{
   width:50px;
   position: fixed;
   right: 65px;
   top:35px;
   z-index:2;
   cursor:pointer;
}
p{
   color:white;
}
h1 big {
   color:red;
}
.sticky {
   position: fixed;
   top: 0;
   width: 100%;
}
.sticky + .content {
   padding-top: 60px;
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
.main {
   margin-left: 200px; 
   font-size: 20px; 
   padding: 0px 10px;
}
.active {
   background-color: yellow;
   color: white;
}
.content{
   overflow: hidden;
   background-color:rgba(6,1,2,0.2);
   text-align: center;
   padding: 1px 15px 15px 15px;
   font-size:20px;
}
#test{
    height:50px;
    width:100px;
}
	</style>
</head>
<body>
   <div id="navbar">
		<div class="container">
			<img src="https://5.imimg.com/data5/TK/AD/MY-36130657/flight-booking-500x500.png" class="img-fluid" width="171.2" height="100" style="float:left">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				<li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> SignUp</a></li>
			</ul>
		</div>
	</div>
		<div class="content">
			<br>
			<br>
			<br>
			<br>
			<div class="content">
				  <center><h6 class="mb-1" style="background-color: YellowGreen; font-size: 50px;color: white; text-shadow:2px 2px black;">Online Booking & Reservation</h6></center>
				  <br>
               <p>We are responsible for booking flight tickets and handle reservations for customers.<br>We are the face of the airline industry and the first point of contact for any customer while boarding a flight.
               <br>Our customers who hold an account in our application can book flight tickets in ease.
               <br><a style= "background-color: white;" href="login.php"> Login </a>
				   <a style= "background-color: white;" href="signup.php"> SignUp</a>
               to continue enjoying our services!! </p>
         <!--	<center><a href="login.php" class="btn btn-info btn-rounded btn-lg">BOOK NOW!</a></center>
		-->  
       </div>
		  </div>
			  </div>
				</div>

</body>
</html>
