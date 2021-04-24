 <?php
 header('Cache-Control: no cache'); //no cache
 session_cache_limiter('private_no_expire'); // works
     session_start();
    $showalert=false;
   $nameErr = $emailErr = $showError="";
   $f=0;
   if($_SERVER["REQUEST_METHOD"] == "POST")
    {
    include 'connect.php';                              
    $username = $_POST["username"];
    $name=$_POST["name"];   
    $gender=$_POST["gender"];
    $password = $_POST["pwd"];
    $cpassword = $_POST["cpwd"];
    $email=$_POST["email"];
    $phno=$_POST["phno"];
    $exists=false;
    if (empty($_POST["name"])) {
      $nameErr = "Name is required" ;
    } 
      // check if name only contains letters and whitespace
      else if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $nameErr = "Only letters and white space allowed";
        $f=1;
      }
    
    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
      $f=1;
    }
    $sql_u = "SELECT * FROM `login` WHERE login_username='$username'";
  	$sql_e = "SELECT * FROM customer WHERE email='$email'";
  	$res_u = mysqli_query($conn, $sql_u);
  	$res_e = mysqli_query($conn, $sql_e);

  	if (mysqli_num_rows($res_u) > 0) {
  	  $nameErr = "Sorry... username already taken"; 	
  	}else if(mysqli_num_rows($res_e) > 0){
  	  $emailErr = "Sorry... email already taken.Kindly login or use another email"; 	
  	}else{
    if(($password == $cpassword) && $exists==false && $f==0){
        $sql = "INSERT INTO `login` ( `login_username`, `password`) VALUES ('$username', '$password')";
        $result = mysqli_query($conn, $sql);
        if ($result){
        //    $showalert = true;
        }
        else
        echo("Error description: " . mysqli_error($conn));
 
    }
    else if($password != $cpassword){
        $showError = "Error inserting.!Check if password and confirm password match";   
    }
    if($exists==false && $f==0)
   { 
     $sql = "INSERT INTO `customer` (`Cust_name`,`gender`,`email`,`phone_number`,`login_username`) VALUES ('$name','$gender','$email','$phno','$username')";
     $result = mysqli_query($conn, $sql);
     $showalert=true;
     $_SESSION['user'] = $username;
     if(!isset($_SESSION["user"]))
    {
     header("location: searchflights.php");
    }
   }
    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="signup.css" type="text/css">
    <style>
    label{
	    color: #666;
      position: center;
      cursor: pointer;
      padding-left: 5px;
    }
    
    #navbar {
      overflow: hidden;
      background-color:rgba(0,0,0,0.2);
      text-align: right;
    }
    #navbar a {
      float: right;
      display: block;
      color: red;
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
    body{
        background-image: url("https://monroeaerospace.com/blog/wp-content/uploads/2019/08/airplane-landing-lights-874x452.jpg");
        background-repeat: no-repeat;
      background-position: center;
      background-size:cover,contain;
    } 
    .headingstyle{
      background-image: url("images/signup.jpg");
      background-repeat: no-repeat;
      background-position: center;
      background-size:cover,contain;
      color:;
    }
    .panel_style{
      margin-top: 0.5%;
    }
    </style>
  </head>
  <body>
    <div id="navbar">
			<img src="https://5.im
