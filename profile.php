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
 $sql="Select * from  login join customer on login.login_username=customer.login_username where login.login_username='$user'";
 $sql2="Select count(*) from enquiry where login_username='$user'";
 $sql3="Select count(*) from enquiry where login_username='$user' and enquiry_answer is null";
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
    $sql4="Select count(*) from ticket where aadhar_no in (Select Aadhar_no from passenger_info where P_email='$email')";
    $sql5="Select count(*) from passenger_info where P_email='$email'";
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

.profile-nav, .profile-info{
    margin-top:30px;   
}

.profile-nav .user-heading {
    background: #afa8d8;;
    color: #fff;
    border-radius: 4px 4px 0 0;
    -webkit-border-radius: 4px 4px 0 0;
    padding: 30px;
    text-align: center;
}

.profile-nav .user-heading.round a  {
    border-radius: 50%;
    -webkit-border-radius: 50%;
    border: 10px solid rgba(255,255,255,0.3);
    display: inline-block;
}

.profile-nav .user-heading a img {
    width: 112px;
    height: 112px;
    border-radius: 50%;
    -webkit-border-radius: 50%;
}

.profile-nav .user-heading h1 {
    font-size: 22px;
    font-weight: 300;
    margin-bottom: 5px;
}

.profile-nav .user-heading p {
    font-size: 12px;
}

.profile-nav ul {
    margin-top: 1px;
}

.profile-nav ul > li {
    border-bottom: 1px solid #ebeae6;
    margin-top: 0;
    line-height: 30px;
}

.profile-nav ul > li:last-child {
    border-bottom: none;
}

.profile-nav ul > li > a {
    border-radius: 0;
    -webkit-border-radius: 0;
    color: #89817f;
    border-left: 5px solid #fff;
}

.profile-nav ul > li > a:hover, .profile-nav ul > li > a:focus, .profile-nav ul li.active  a {
    background: #f8f7f5 !important;
    border-left: 5px solid #fbc02d;
    color: #89817f !important;
}

.profile-nav ul > li:last-child > a:last-child {
    border-radius: 0 0 4px 4px;
    -webkit-border-radius: 0 0 4px 4px;
}

.profile-nav ul > li > a > i{
    font-size: 16px;
    padding-right: 10px;
    color: #bcb3aa;
}

.r-activity {
    margin: 6px 0 0;
    font-size: 12px;
}


.p-text-area, .p-text-area:focus {
    border: none;
    font-weight: 300;
    box-shadow: none;
    color: #c3c3c3;
    font-size: 16px;
}

.profile-info .panel-footer {
    background-color:#f8f7f5 ;
    border-top: 1px solid #e7ebee;
}

.profile-info .panel-footer ul li a {
    color: #7a7a7a;
}

.bio-graph-heading {
    background: #afa8d8;
    color: #fff;
    text-align: center;
    font-style: italic;
    padding: 40px 110px;
    border-radius: 4px 4px 0 0;
    -webkit-border-radius: 4px 4px 0 0;
    font-size: 16px;
    font-weight: 300;
}

.bio-graph-info {
    color: #89817e;
}

.bio-graph-info h1 {
    font-size: 22px;
    font-weight: 300;
    margin: 0 0 20px;
}

.bio-row {
    width: 50%;
    float: left;
    color:black;
    margin-bottom: 10px;
    padding:0 15px;
}

.bio-row p span {
    width: 100px;
    display: inline-block;
}

.bio-chart, .bio-desk {
    float: left;
}

.bio-chart {
    width: 40%;
}

.bio-desk {
    width: 60%;
}

.bio-desk h4 {
    font-size: 15px;
    font-weight:1000;
}

.bio-desk h4.terques {
    color: #4CC5CD;
}

.bio-desk h4.red {
    color: #e26b7f;
}

.bio-desk h4.green {
    color: #97be4b;
}

.bio-desk h4.purple {
    color: #caa3da;
}

.file-pos {
    margin: 6px 0 10px 0;
}

.profile-activity h5 {
    font-weight: 300;
    margin-top: 0;
    color: #c3c3c3;
}

.summary-head {
    background: #ee7272;
    color: #fff;
    text-align: center;
    border-bottom: 1px solid #ee7272;
}

.summary-head h4 {
    font-weight: 300;
    text-transform: uppercase;
    margin-bottom: 5px;
}

.summary-head p {
    color: rgba(255,255,255,0.6);
}

ul.summary-list {
    display: inline-block;
    padding-left:0 ;
    width: 100%;
    margin-bottom: 0;
}

ul.summary-list > li {
    display: inline-block;
    width: 19.5%;
    text-align: center;
}

ul.summary-list > li > a > i {
    display:block;
    font-size: 18px;
    padding-bottom: 5px;
}

ul.summary-list > li > a {
    padding: 10px 0;
    display: inline-block;
    color: #818181;
}

ul.summary-list > li  {
    border-right: 1px solid #eaeaea;
}

ul.summary-list > li:last-child  {
    border-right: none;
}

.activity {
    width: 100%;
    float: left;
    margin-bottom: 10px;
}

.activity.alt {
    width: 100%;
    float: right;
    margin-bottom: 10px;
}

.activity span {
    float: left;
}

.activity.alt span {
    float: right;
}
.activity span, .activity.alt span {
    width: 45px;
    height: 45px;
    line-height: 45px;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    background: #eee;
    text-align: center;
    color: #fff;
    font-size: 16px;
}

.activity.terques span {
    background: #8dd7d6;
}

.activity.terques h4 {
    color: #8dd7d6;
}
.activity.purple span {
    background: #b984dc;
}

.activity.purple h4 {
    color: #b984dc;
}
.activity.blue span {
    background: #90b4e6;
}

.activity.blue h4 {
    color: #90b4e6;
}
.activity.green span {
    background: #aec785;
}

.activity.green h4 {
    color: #aec785;
}

.activity h4 {
    margin-top:0 ;
    font-size: 16px;
}

.activity p {
    margin-bottom: 0;
    font-size: 13px;
}

.activity .activity-desk i, .activity.alt .activity-desk i {
    float: left;
    font-size: 18px;
    margin-right: 10px;
    color: #bebebe;
}

.activity .activity-desk {
    margin-left: 70px;
    position: relative;
}

.activity.alt .activity-desk {
    margin-right: 70px;
    position: relative;
}

.activity.alt .activity-desk .panel {
    float: right;
    position: relative;
}

.activity-desk .panel {
    background: #F4F4F4 ;
    display: inline-block;
}


.activity .activity-desk .arrow {
    border-right: 8px solid #F4F4F4 !important;
}
.activity .activity-desk .arrow {
    border-bottom: 8px solid transparent;
    border-top: 8px solid transparent;
    display: block;
    height: 0;
    left: -7px;
    position: absolute;
    top: 13px;
    width: 0;
}

.activity-desk .arrow-alt {
    border-left: 8px solid #F4F4F4 !important;
}

.activity-desk .arrow-alt {
    border-bottom: 8px solid transparent;
    border-top: 8px solid transparent;
    display: block;
    height: 0;
    right: -7px;
    position: absolute;
    top: 13px;
    width: 0;
}

.activity-desk .album {
    display: inline-block;
    margin-top: 10px;
}

.activity-desk .album a{
    margin-right: 10px;
}

.activity-desk .album a:last-child{
    margin-right: 0px;
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
                      <div class="panel-body">
                          <div class="bio-chart">
                              <div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="<?php echo $row2["count(*)"] ?>" data-fgcolor="#e06b7d" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(224, 107, 125); padding: 0px; -webkit-appearance: none; background: none;"></div>
                          </div>
                          <div class="bio-desk">
                              <h4 class="red">Number of enquires made </h4>
                              <p>Answered Queries :<?php echo $pend ?></p>
                              <p>Pending Queries: <?php echo $row3['count(*)'] ?></p>
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
                              <p>Passengers : <?php echo $row5['count(*)'] ?></p>
                              <p>Tickets : <?php echo $tic ?></p>
                          </div>
                          
                      </div>
                  </div>
              </div>
              <div class="row">
              <div class="col-md-6">
              <div class="panel">
                      <div class="panel-body">
                      <?php
                      $sql3="CALL `enquiry_user`('$user');";
$res=mysqli_query($conn,$sql3);
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
echo '</table>';?>
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

</script>