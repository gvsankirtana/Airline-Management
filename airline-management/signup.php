 <?php
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
        $sql = "INSERT INTO `customer` (`Cust_name`,`gender`,`email`,`phone_number`,`login_username`) VALUES ('$name','$gender','$email','$phno','$username')";
     $result = mysqli_query($conn, $sql);
     $_SESSION["user"]=$username;
     $showalert=true;
 
    }
    else if($password != $cpassword){
        $showError = "Error inserting.!Check if password and confirm password match";   
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
			<img src="https://5.imimg.com/data5/TK/AD/MY-36130657/flight-booking-500x500.png" class="img-fluid" width="200" height="100" style="float:left">
		</div>
    <div class="container panel_style">
      <div class="col-xs-6 col-xs-offset-3">
        <div class="panel border border-dark">
        <div class="panel-heading headingstyle">
            <?php
            if($showalert){
          echo '  <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Well done!</h4>
            <p>You have successfuly created a account in our application!</p>
            Click <a href="searchflights.php" >Here to book flights</a>
            <hr>
           </div> ';
            }
            ?>
            <h4><center><b>Signup Now !!</b></center></h4>
          </div>
          <div class="panel-body">
            <form action="/flight_management/Airport-management/signup.php" method="post">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" name="name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Username"  name="username">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password"  name="pwd">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Confirm Password"  name="cpwd">
              </div>
              <div class="form-check row">
                <div class="col-xs-3">
                  <input type="radio" name="gender" value="female" >
                  <label class="form-check-label">Female</label>
                </div>
                <div class="col-xs-2">
                  <input type="radio" name="gender" value="male">
                  <label class="form-check-label">Male</label>
                </div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" name="email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Phone Number" name="phno">
              </div>
              <button class="btn btn-info" type="submit">Sign up!</button>
              <span class="error"><?php echo $nameErr;?></span>
            <br>  <span class="error"><?php echo $emailErr;?></span>
            <br>  <span class="error"><?php echo $showError;?></span>

            </form>
          </div>
          <div class="panel-footer"> Have an account? <a href="login.php">Login</a> <br>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
