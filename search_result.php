<?php
session_start();
     if(($_SESSION["user"])==null)
     {
      header("location: login.php");
     }

$f=1;$fl=0;
$from=null;$to=null;$class=null;$date=null;$seats=null;
if( $_SERVER["REQUEST_METHOD"] == "POST")
{ 
include 'connect.php';
$from = $_POST["fcity"];
$to=$_POST["tcity"]; 
$class=$_POST["class"];
$date=$_POST["traveldate"];
$seats = $_POST["seats"];
  $sql="Select * from airline_view where departure_Destination='$from' and arrival_Destination='$to' and dept_date='$date' and vacant_seats>='$seats' order by economy_Fare";
  $res=mysqli_query($conn,$sql);
  if ($res){
    }
    else
    echo("Error description: " . mysqli_error($conn));
  $f=1; 
  echo 
  '<div class="result">
  <form method="POST" action="passenger_info_table.php">
  <table border=3 class="table table-bordered table-hover" align="center" style="font-size:15px; background-color: #FADCC8;height:50%;width:50%">
  <thead>
  <tr><th colspan="13"><h3>Airline Search Results from '.$_POST["fcity"].' to '.$_POST["tcity"] .' in '.$_POST["class"].':</h3></th></tr>
  <tr>
        <th scope="col">Flight_ID</th>
        <th scope="col">Airline_Name</th>
        <th scope="col">Fare</th>
        <th scope="col">Dept_time</th>
        <th scope="col">Dept_date</th>
        <th scope="col">Arrival_time</th>
        <th scope="col">Arrival_date</th>
        <th scope="col"></th>
      </tr>
    </thead>
    ' ;
    if($class=="Economy"){
    while($rows=mysqli_fetch_assoc($res))
    {
      echo "
      <input type='hidden' name='class' value=$class />
      <input type='hidden' name='flight' value='{$rows['Flight_ID']}' />
      <input type='hidden' name='seats' value=$seats />
      <tr><td>{$rows['Flight_ID']}</td>
       <td>{$rows['Airline_name']}</td> 
       <td>{$rows['economy_Fare']}</td> 
       <td>{$rows['dept_Time']}</td>
       <td>{$rows['dept_date']}</td>
       <td>{$rows['arrival_time']}</td>
       <td>{$rows['arrival_date']}</td>
       <td><input type='submit'name='submit' value='BOOK NOW!'/></td><tr>";
    }
echo '</table></form></div>';
  }
  else if($class=="Buisness")
  {
    while($rows=mysqli_fetch_assoc($res))
    {
      echo "
      <input type='hidden' name='class' value=$class />
      <input type='hidden' name='flight' value='{$rows['Flight_ID']}' />
      <input type='hidden' name='seats' value=$seats />
      <tr><td>{$rows['Flight_ID']}</td>
       <td>{$rows['Airline_name']}</td> 
       <td>{$rows['buisness_fare']}</td> 
       <td>{$rows['dept_Time']}</td>
       <td>{$rows['dept_date']}</td>
       <td>{$rows['arrival_time']}</td>
       <td>{$rows['arrival_date']}</td>
       <td><input type='submit'name='submit' value='BOOK NOW!'/></td><tr>";
    }
echo '</table></form></div>';
  }
}

//INSERT INTO `airline`(`Flight_ID`, `Flight_Type`, `Airline_name`, `Reference_no`, `economy_Fare`, `buisness_fare`, `vacant_seats`, `dept_Time`, `dept_date`, `departure_Destination`, `arrival_time`, `arrival_date`, `arrival_destination`) VALUES ('1234','Airbus A350','Indian Airways','WY233','3200','9999','220','22:00:00','2021-05-01','Mumbai','23;45:00','2021-05-01','Chennai');
 
?>


<!DOCTYPE html>
<html>
<head>
<title>Search Flights</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
  background-image: url("https://www.thephotoforum.com/attachments/thousand_steps3-jpg.95195/");
  background-repeat: no-repeat;
  background-size: cover;
}
.result{
  position: absolute;
  top: 80%;
  height:100%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  
}



.main {
  margin-left: 10px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}


@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
html, body {
      min-height: 100%;
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
input[type=button], input[type=submit], input[type=reset] {
  background-color: #4f86f9;
  -webkit-border-radius: 60px;
  border-radius: 60px;
  border: none;
  color: #eeeeee;
  cursor: pointer;
  display: inline-block;
  font-family: sans-serif;
  font-size: 20px;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
}
@keyframes glowing {
  0% {
    background-color: #2ba805;
    box-shadow: 0 0 3px #2ba805;
  }
  50% {
    background-color: #49e819;
    box-shadow: 0 0 10px #49e819;
  }
  100% {
    background-color: #2ba805;
    box-shadow: 0 0 3px #2ba805;
  }
}
input[type=button], input[type=submit]{
        animation: glowing 1300ms infinite;
}
      </style>
<body>
<div class="main">
</div>
</body>
</html>