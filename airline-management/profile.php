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
    if($_SERVER["REQUEST_METHOD"] == "POST" and $_POST["flag"]=="1")
     {
          $type = $_POST['type'];
         $title = $_POST['enquirytitle'];
         $description = $_POST['desc'];
         $sql = "CALL `inserenq`('$title','$type','$description','$user')";
       // $sql = "INSERT INTO `enquiry` ( `Enquiry_type`, `Enquiry_title`,`Enquiry_Description`,`login_username`) VALUES ('$title', '$type','$description','$user')";
         $result = mysqli_query($conn, $sql);
         if ($result){
         $showalert = true;
         }
         else
         echo("Error description: " . mysqli_error($conn));

     }
     else if($_SERVER["REQUEST_METHOD"] == "POST" and $_POST["flag"]=="2" )
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
    $adhar = $_POST['adhar'];
    $del="Delete from passenger_info where Aadhar_No='$adhar'";//trigger to ticket table here
    $c=mysqli_query($conn,$del);
    if ($c){
        $showalert2 = true;
    echo 'Succesfully deleted passenger';
    }
    else
    echo("Error description: " . mysqli_error($conn));

}
 $sql="Select * from  login join customer on login.login_username=customer.login_username where login.login_username='$user'";
 $sql2="SELECT `passenger_enq`('$user') AS `passenger_enq`";
 $sql3="SELECT `passenger_enq_answered`('$user') AS `passenger_enq_answered`";
 $res=mysqli_query($conn,$sql);
  $res2=mysqli_query($conn,$sql2);
  $res3=mysqli_query($conn,$sql3);

//$resf=mysqli_query($conn,$sqlf);
//$rowf=mysqli_fetch_assoc($resf);
//echo $rowf["count"];
  if ($res){
    }
    else
    echo("Error description: " . mysqli_error($conn));
    $row=mysqli_fetch_assoc($res);
    $email=$row["email"];

    $row2=mysqli_fetch_assoc($res2);
    $row3=mysqli_fetch_assoc($res3);
    $sql4="SELECT `ticket_count`('$email') AS `ticket_count`";
    $sql5="SELECT `passenger_count`('$email') AS `passenger_count`";
    $res4=mysqli_query($conn,$sql4);
    $res5=mysqli_query($conn,$sql5);
    $row4=mysqli_fetch_assoc($res4);
    $row5=mysqli_fetch_assoc($res5);

    $tic=$row4['count(*)'];
   
    
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
          <form action="profile.php" method="post">
          <input  class="form-control" placeholder="Your Enquiry Title" type="text" id="enquirytitle" name="enquirytitle" required/><br>
          <select  name="type"  class="form-control">
          <option value="Feedback">Feedback</option>
            <option value="complaint">Complaint</option>
            <option value="Question">Question </option>
            </select>
            <br>
         <div class="panel">
        <textarea placeholder="Do you want to ask us something" rows="2" class="form-control input-lg p-text-area" name="desc"></textarea>
          <footer class="panel-footer">
          <input type="hidden" name="flag" value="1"/>
              <button type="submit" class="btn btn-warning pull-right">Ask</button>
              </form>

              <ul class="nav nav-pills">
              </ul>
          </footer>
      </div>
      <div class="panel">
          <div class="bio-graph-heading" style="color:black;font-size:20px;">
          Welcome <?php print_r($row["Cust_name"]);?>!You have been an amazing customer and always supported us . We love to be in service for you.
          </div>
          <div class="panel-body bio-graph-info">
              <h1>Bio Graph</h1>
              <div class="row">
                  <div class="bio-row">
                      <p><span>Name </span>: <?php print_r($row["Cust_name"]);?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Gender </span>: <?php print_r($row["gender"]);?></p>
                  </div>
                  <div class="bio-row">
                      <p><span>Phone number</span>: <?php print_r($row["phone_number"]);?></p>
                  </div>
                  
                  <div class="bio-row">
                      <p><span>Login username </span>: <?php print_r($row["login_username"]);?></p>
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
                          <div class="bio-chart">
                              <div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="<?php echo $row2['passenger_enq']; ?>" data-fgcolor="#e06b7d" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(224, 107, 125); padding: 0px; -webkit-appearance: none; background: none;"></div>
                          </div>
                          <div class="bio-desk">
                              <h4 class="red">Number of enquires made </h4>
                              <p>Answered Queries :<?php echo $row2['passenger_enq']-$row3['passenger_enq_answered'];?></p>
                              <p>Pending Queries: <?php echo $row3['passenger_enq_answered'] ?></p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="panel">
                      <div class="panel-body">
                          <div class="bio-chart">
                              <div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="<?php echo $tic ?>" data-fgcolor="#4CC5CD" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(76, 197, 205); padding: 0px; -webkit-appearance: none; background: none;"></div>
                          </div>
                          <div class="bio-desk">
                              <h4 class="terques">Number of tickets booked </h4>
                              <p>Passengers : <?php echo $row5['passenger_count'] ?></p>
                              <p>Tickets : <?php echo $row4['ticket_count'] ?></p>
                          </div>
                          
                      </div>
                  </div>
              </div>
              <div class="row">
              <div class="col-md-6">
              <div class="panel">
                      <div class="panel-body">
                      <?php
                      $begin="BEGIN";
                      $res=mysqli_query($conn,$begin);
                      while(mysqli_next_result($conn)){;}
                    $sql3="CALL `enquiry_user`('$user');";
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
	echo "<tr><td>{$rows['enquiry_title']}</td>
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
      <div class="row">
              <div class="col-md-6">
              <div class="panel">
                      <div class="panel-body">
                      <?php
                      $begin="BEGIN";
                      $res=mysqli_query($conn,$begin);
                      while(mysqli_next_result($conn)){;}
                    $sql3="CALL `passenger_user`('$user');";
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
<tr><th colspan="20"><h3>Your Passengers details saved with us</h3></th></tr>
<tr>
	  <th scope="col" style="text-color:black;">Aadhar_no</th>
	  <th scope="col">Name</th>
	  <th scope="col">Date of Birth</th>
	  <th scope="col">Gender</th>
	  <th scope="col">Age</th>
      <th scope="col">State</th>
      <th scope="col">City</th>
      <th scope="col">Pincode</th>
	</tr>
  </thead>
  ' ;
  while($rows=mysqli_fetch_assoc($res))
  {
	echo "<tr><td>{$rows['Aadhar_No']}</td>
	 <td>{$rows['P_Name']}</td> 
	 <td>{$rows['P_DOB']}</td> 
     <td>{$rows['P_gender']}</td>
     <td>{$rows['P_age']}</td>
     <td>{$rows['state']}</td> 
	 <td>{$rows['city']}</td> 
	 <td>{$rows['pincode']}</td><tr>";
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
                      <span><a href="javascript:void(0);" onclick="show2();">Want to delete passenger?</a>
    <div id="dThreshold2" style="display: none">
    <form action="profile.php" method="post">
    <div class="form-group">
                <input type="text" placeholder="Passenger Aadhar to be deleted" class="form-control"  name="adhar">
              </div>    
              <input type="hidden" name="flag" value="3"/>
              <button class="btn btn-danger" type="submit" >Delete Passenger!</button>
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
