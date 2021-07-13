 <?php 
     session_start();
     if(($_SESSION["user"])==null)
     {
      header("location: login.php");
     }
     $user=$_SESSION["user"];
    
     include 'connect.php';
     $showalert=false;$wrong=false;$showalert2=false;
     $flag=0; 
//     $coord="Select count(*) from airline_coordinator where login_username=(Select login_username from  login where login_username='$user')";
//as a function
$coord="SELECT `find_employee_type`('$user') AS `find_employee_type`";  
$q=mysqli_query($conn,$coord);
     $count=mysqli_num_rows($q);
     
     if ($count==0){
            $u="cuscare";
     }
     else
     $u="coord";
     
    if($_SERVER["REQUEST_METHOD"] == "POST" and $_POST["flag"]=="2" )
{
    $password = $_POST["pwd"];
    $opassword = $_POST["opwd"];
    $cpassword = $_POST["cpwd"];
    $check="Select password from  login where login_username='$user'";
    $c=mysqli_query($conn,$check);
    $row=mysqli_fetch_assoc($c);
    $op=$row['password'];
    if($op==$opassword)
    {
         if($password != $cpassword){

            echo "Error inserting.!Check if password and confirm password match";   
        }
        else
        {
            // Trigger `update_password` has been created.
//CREATE TRIGGER `update_password` AFTER UPDATE ON `login` FOR EACH ROW Update login set password=NEW.password where login_username=NEW.login_username;
            $upd="Update login set password='$password' where login_username='$user'";
            $c=mysqli_query($conn,$upd);
        
            if ($c){
                    $showalert2 = true;
                echo 'Succesfully changed password';

                }
                else
                echo("Error description: " . mysqli_error($conn));
         
        }
    }
    else
    {
        $wrong=true;
        echo 'wrong password';
    }
}

else if($_SERVER["REQUEST_METHOD"] == "POST" and $_POST["flag"]=="3" )
{
    $flight = $_POST['flight'];
    if($u=="coord")
    $del="Delete from airline where Flight_ID='$flight'";//trigger to ticket table here
    else 
    echo 'You are not a airline coordinator';
    $c=mysqli_query($conn,$del);
    if ($c){
        $showalert2 = true;
    echo 'Succesfully deleted passenger';
    }
    else
    echo("Error description: " . mysqli_error($conn));

}
if($u=="cuscare")
{
$sql="Select * from  login join customer_care_agent a on login.login_username=a.login_username where login.login_username='$user'";
$sql2="SELECT `empl_answered`('$user') AS `empl_answered`";//no of answered queries
$sql3="SELECT `pending_answer_all`() AS `pending_answer_all`";//pending

 $res=mysqli_query($conn,$sql);
  $res2=mysqli_query($conn,$sql2);
  $res3=mysqli_query($conn,$sql3);

  if ($res){
    }
    else
    echo("Error description: " . mysqli_error($conn));
    $row=mysqli_fetch_assoc($res);
    $email=$row["email"];

    $row2=mysqli_fetch_assoc($res2);
    $row3=mysqli_fetch_assoc($res3);
    $pend=$row2['count(*)']-$row3['count(*)'];
 }
 else if($u=="coord")
{
    $sql="Select * from  login join airline_coordinator a on login.login_username=a.login_username where login.login_username='$user'";
$sql2="SELECT `manage_flight`($user) AS `manage_flight`";//no of flight managed

 $res=mysqli_query($conn,$sql);
  $res2=mysqli_query($conn,$sql2);

  if ($res){
    }
    else
    echo("Error description: " . mysqli_error($conn));
    $row=mysqli_fetch_assoc($res);
    $email=$row["email"];

    $row2=mysqli_fetch_assoc($res2);
 } 
 $sql4="Select count(*) from ticket where aadhar_no in (Select Aadhar_no from passenger_info where P_email='$email')";
    $sql5="Select count(*) from passenger_info where P_email='$email'";
    $res4=mysqli_query($conn,$sql4);
    $res5=mysqli_query($conn,$sql5);
    $row4=mysqli_fetch_assoc($res4);
    $row5=mysqli_fetch_assoc($res5);

   
    
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
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="profile.css">
  <style>
body {
    color: #797979;
    background: pink;
    font-family: 'Open Sans', sans-serif;
    padding: 0px !important;
    margin: 0px !important;
    font-size: 18px;
    text-rendering: optimizeLegibility;
    -webkit-font-smoothing: antialiased;
    -moz-font-smoothing: antialiased;
}

</style>
<div class="container bootstrap snippets bootdey">
<div class="panel border border-dark">
        <div class="panel-heading headingstyle">
            <?php
            if($showalert){
          echo '  <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Thank you for reaching out!</h4>
            <p>Your enquiry has been sent to our team and will be answered shortly!</p>
            <hr>
           </div> ';
            }
            if($showalert2){
                echo '  <div class="alert alert-success" role="alert">
                  <h4 class="alert-heading">Password updated!</h4>
                  <hr>
                 </div> ';
                  }
            ?>
<div class="row">
  <div class="profile-nav col-md-3">
      <div class="panel">
          <div class="user-heading round">
              <a href="#">
                  <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="">
              </a>
              <h1><?php print_r($_SESSION["user"]);?></h1>
              <p><?php print_r($row["email"]);?></p>
          </div>

          <ul class="nav nav-pills nav-stacked">
              <li class="active"><a href="#"> <i class="fa fa-user"></i> Profile</a></li>
             
          </ul>
      </div>
  </div>
  <div class="profile-info col-md-9">

      <div class="panel">
          <div class="bio-graph-heading" style="color:black;font-size:20px;">
          Welcome <?php print_r($row["Emp_name"]);?>!You have been an amazing employee and always supported us . We love to be in service for you.
          </div>
          <div class="panel">
          <div class="panel-body bio-graph-info">
              <h1>Bio Graph</h1>
              <div class="row">
                  <div class="bio-row">
                      <p><span>Name </span>: <?php print_r($row["Emp_name"]);?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Gender </span>: <?php print_r($row["gender"]);?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Phone number</span>: <?php print_r($row["phone_no"]);?></p>
                  </div>
                  <div>
                  <div class="bio-row">
                      <p><span>Salary</span>: <?php print_r($row["salary"]);?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Role</span>: <?php print_r($row["Role"]);?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Date of Joining</span>: <?php print_r($row["Date_of_join"]);?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Login username </span>: <?php print_r($row["Login_username"]);?></p>
                  </div>
                  <span><a href="javascript:void(0);" onclick="show();">Want to update password?</a>
                  <div id="dThreshold" style="display: none">
                     <form action="profile.php" method="post">
                       <div class="form-group">
                <input type="password" placeholder="Old Password" class="form-control"  name="opwd">
              </div>    
              <div class="form-group">
                <input type="password" placeholder="New Password" class="form-control" name="pwd">
              </div>
              <div class="form-group">
                <input type="password" placeholder="Confirm Password" class="form-control"  name="cpwd">
              </div> 
              <input type="hidden" name="flag" value="2"/>
              <button class="btn btn-info" type="submit" >Update Password!</button>
 
              </div></span>
              </div>
          </div>
      </div>
      <div>
          <div class="row">
              <div class="col-md-6">
                  <div class="panel">
                      <div cdlass="panel-body">
                      You are a <?php echo $u?>

                      <?php if ($u=="cuscare") { ?>
                        <div class="bio-chart">
                              <div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="<?php echo $row2['empl_answered'] ?>" data-fgcolor="#e06b7d" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(224, 107, 125); padding: 0px; -webkit-appearance: none; background: none;"></div>
                          </div>
                          <div class="bio-desk">
                                <h4 class="red">Number of enquires answered. </h4>
                              <p>Answered Queries :<?php echo $row2['empl_answered'] ?></p>
                              <p>Pending Queries: <?php echo $row3['pending_answer_all'] ?></p>
                      </div>
                              <?php } ?>

                      </div>
                          </div>
                      </div>
              </div>
              <div class="col-md-6">
                  <div class="panel">
                      <div class="panel-body">
                          <?php if ($u=="coord") { ?>
                            <div class="bio-chart">

                              <div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="<?php echo $row2['count(*)'] ?>" data-fgcolor="#4CC5CD" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(76, 197, 205); padding: 0px; -webkit-appearance: none; background: none;"></div>
                          </div>
                          <div class="bio-desk">
                              <h4 class="terques">Number of flights managed  by you</h4>
                              <p>Flights : <?php echo $row2['manage_flight'] ?></p>   
                          </div>           
                      <?php } ?>
                      </div>

                  </div>
              </div>
            </div><br><br><br><br><br><br><br><br>
              <div class="row">
              <div class="col-md-6">
              <?php if ($u=="cuscare") { ?>
              <div class="panel">
                      <div class="panel-body">
                      <?php
                      $begin="BEGIN";
                      $res=mysqli_query($conn,$begin);
                      while(mysqli_next_result($conn)){;}
                    $sql3="CALL `pend_queries`();";
$res=mysqli_query($conn,$sql3);
while(mysqli_next_result($conn)){;}
if ($res){
  }
  else
  echo("Error description: " . mysqli_error($conn));
$f=1;

echo 
'
<table border=10 class="table table-bordered table-hover" id="tab_logic" align="center"  style="font-size:20px;background-color: #afa8d8;color:black;">
<thead>
<tr><th colspan="20"><h3>Your enquiries</h3></th></tr>
<tr>
	  <th scope="col" style="text-color:black;">Enquiry Title</th>
	  <th scope="col">Enquiry Type</th>
	  <th scope="col">Enquiry Description</th>
	  <th scope="col">Enquiry Answer</th>
	</tr>
  </thead>
  ' ;
  while($rows=mysqli_fetch_assoc($res))
  {
	echo "<tr><td>{$rows['Enquiry_title']}</td>
	 <td>{$rows['Enquiry_type']}</td> 
	 <td>{$rows['Enquiry_Description']}</td> 
	 <td>{$rows['enquiry_answer']}</td><tr>";
  }
echo '</table>';
$end="END;";
$res=mysqli_query($conn,$end);
while(mysqli_next_result($conn)){;}?>

              </div>
          </div>
      </div>
      </div>
      <?php } ?> 
      <div class="row">
              <div class="col-md-6">
              <div class="panel">
                      <div class="panel-body">
                      <?php
                      $begin="BEGIN";
                      $res=mysqli_query($conn,$begin);
                      while(mysqli_next_result($conn)){;}
                    $sql3="CALL `all_flights`();";
$res=mysqli_query($conn,$sql3);
while(mysqli_next_result($conn)){;}
if ($res){
  }
  else
  echo("Error description: " . mysqli_error($conn));
$f=1;

echo 
'
<table border=10 class="table table-bordered table-hover" id="tab_logic" align="center"   style="table-layout:absolute;width:100%; font-size:20px;background-color: #afa8d8;color:black;">
<thead>
<tr><th colspan="20"><h3>Your Flight details saved:</h3></th></tr>
<tr>
	  <th scope="col" style="text-color:black;">Flight_ID</th>
	  <th scope="col">Reference_NO</th>
	  <th scope="col">economy_Fare</th>
	  <th scope="col">buisness_Fare</th>
	  <th scope="col">vacant_seats</th>
      <th scope="col">dept_time</th>
      <th scope="col">dept_date</th>
      <th scope="col">Departure destination</th>
      <th scope="col">Arrival Time</th>
      <th scope="col">Arrival date</th>
      <th scope="col">Arrival destination</th>        
	</tr>
  </thead>
  ' ;
  while($rows=mysqli_fetch_assoc($res))
  {
	echo "<tr><td>{$rows['Flight_ID']}</td>
	 <td>{$rows['Reference_no']}</td> 
	 <td>{$rows['economy_Fare']}</td> 
     <td>{$rows['buisness_fare']}</td>
     <td>{$rows['vacant_seats']}</td>
     <td>{$rows['dept_Time']}</td> 
     <td>{$rows['dept_date']}</td> 
	 <td>{$rows['departure_Destination']}</td> 
	 <td>{$rows['arrival_time']}</td>
     <td>{$rows['arrival_date']}</td> 
     <td>{$rows['arrival_destination']}</td> 
     <tr>";
  }
echo '</table>';
$end="END;";
$res=mysqli_query($conn,$end);
while(mysqli_next_result($conn)){;}?>

              </div>
    
          </div>
      </div>
      </div>
      <div class="row">
              <div class="col-md-6">
              <div class="panel">
                      <div class="panel-body">
                      <span><a href="javascript:void(0);" onclick="show2();">Want to delete flight?</a>
    <div id="dThreshold2" style="display: none">
    <form action="profile.php" method="post">
    <div class="form-group">
                <input type="text" placeholder="Passenger flight to be deleted" class="form-control"  name="flight">
              </div>    
              <input type="hidden" name="flag" value="3"/>
              <button class="btn btn-danger" type="submit" >Delete Flight!</button>
                      </div>
    </div>
</div>
  </div>
</div>
</div>
</body>
</html>
<script>
function show() {
    document.getElementById("dThreshold").style.display ="block";
}
function show2() {
    document.getElementById("dThreshold2").style.display ="block";
}
</script>
