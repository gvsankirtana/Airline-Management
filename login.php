<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  include 'connect.php';                            
$username=mysqli_real_escape_string($conn,$_POST["login_username"]);
$password=mysqli_real_escape_string($conn,$_POST["password"]);

$query = "call logincommon('$username', '$password')";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result)>0){
  $query2 = "SELECT * FROM customer WHERE login_username='$username'";
  $result2 = mysqli_query($conn, $query2);
  if ($result2){
    //    $showalert = true;
    }
    else
    echo("Error description: " . mysqli_error($conn));
  $countd=mysqli_num_rows($result2);
  
  if($countd!=0){
    header("location: searchflights.php");
  }
  $query3 = "SELECT * FROM customer_care_agent WHERE login_username='$username'";
  $result3 = mysqli_query($conn, $query3);
  $countd=mysqli_num_rows($result3);
  if($countd!=0){
    header("location: enquiryanswer.php");
  }
  $query4 = "SELECT * FROM airline_coordinator WHERE login_username='$username'";
  $result4 = mysqli_query($conn, $query4);
  $countd=mysqli_num_rows($result4);
  if($countd!=0){
    header("location: airline_details.php");
  }
}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
      body{
        background-image: url("images/login.jpg");
        background-repeat: no-repeat;
        background-position: center;
        background-size:cover,contain;
      }
      .headingstyle{
        background-image: url("images/login.jpg");
        background-repeat: no-repeat;
        background-position: center;
        background-size:cover,contain;
      }
      .panel_style{
        margin-top: 2%;
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
    </style>
  </head>
  <body>
    <div id="navbar">
			<img src="https://5.imimg.com/data5/TK/AD/MY-36130657/flight-booking-500x500.png" class="img-fluid" width="200" height="100" style="float:left">
		</div>
    <div class="container panel_style">
      <div class="col-xs-6 col-xs-offset-3">
        <div class="panel ">
          <div class="panel-heading headingstyle">
            <h3><b>Login</b></h3>
          </div>
          <div class="panel-body">
            <form action="login.php" method="POST">
              <div class="form-group">
                <input type="text" placeholder="Username" class="form-control" id="login_username" name="login_username">
              </div>
              <div class="form-group">
                <input type="password" placeholder="Password" class="form-control" id="password" name="password">
              </div>
              <button class="btn btn-info" type="button submit" value="submit" >Login</button>
              <?php 
              if($_SERVER["REQUEST_METHOD"] == "POST"){
                if($count==0){
                  echo ' <div class="alert alert-danger" role="alert" style="margin-top: 20px; margin-bottom: 0px;">
                  <h5 style={color:red;} class="alert-heading"><b>User account does not exists.</b></h5>
                  </div> ';
                }
              }
              ?>
            </form>
          </div>
          <div class="panel-footer">
            Don't have an account? <a href="signup.php">Sign Up</a> <br>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>