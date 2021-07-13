<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  include 'connect.php';                            
  $username=mysqli_real_escape_string($conn,$_POST["login_username"]);
  $password=mysqli_real_escape_string($conn,$_POST["password"]);
  $query = "SELECT * FROM login WHERE login_username='$username'";
  $result = mysqli_query($conn, $query);
  $count=mysqli_num_rows($result);
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
                  <h5 style={color:red;} class="alert-heading"><b>Username does not exist.</b></h5>
                  </div> ';
                }
                else{
                  $query = "SELECT * FROM login WHERE  password='$password'";
                  $result = mysqli_query($conn, $query);
                  $count=mysqli_num_rows($result);
                  if($count==0){
                    echo ' <div class="alert alert-danger" role="alert" style="margin-top: 20px; margin-bottom: 0px;">
                  <h5 style={color:red;} class="alert-heading"><b>Incorrect Password.</b></h5>
                  </div> ';
                  }
                  else{
                    $_SESSION['user'] = $username;
                    $query = "SELECT * FROM customer WHERE login_username='$username'";
                    $result = mysqli_query($conn, $query);
                    $countd=mysqli_num_rows($result);
                    if($countd!=0){
                      header("location: searchflights.php");
                    }
                    $query = "SELECT * FROM airline_coordinator WHERE login_username='$username'";
                    $result = mysqli_query($conn, $query);
                    $countd=mysqli_num_rows($result);
                    if($countd!=0){
                      header("location: airline_details.php");
                    }
                    $query = "SELECT * FROM customer_Care_Agent WHERE login_username='$username'";
                    $result = mysqli_query($conn, $query);
                    $countd=mysqli_num_rows($result);
                    if($countd!=0){
                      header("location: empenquiryanswer.php");
                    }
                  }
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
