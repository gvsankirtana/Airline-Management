<?php
session_start();
  $f=1;
   if($_SERVER["REQUEST_METHOD"] == "POST")
    { 
    include 'connect.php';
    $from = $_POST["fcity"];
    $to=$_POST["tcity"];
    $class=$_POST["class"];
    $class = $_POST["class"];
    $date=$_POST["traveldate"];
    $seats = $_POST["seats"];
      $sql="Select * from airline where departure_Destination='$from' and arrival_Destination='$to' and dept_date='$date' and vacant_seats>='$seats' order by Economy";
      $res=mysqli_query($conn,$sql);
      if ($res){
        }
        else
        echo("Error description: " . mysqli_error($conn));
      $f=1;
      echo 
      '
      <form method="POST" action="passenger_info_table.php">
      <table border=3 class="table table-bordered table-hover" id="tab_logic" align="center" style="font-size:15px; background-color: #FADCC8;">
      <thead>
      <tr><th colspan="13"><h3>Airline Search Results from '.$_POST["fcity"].' to '.$_POST["tcity"] .' in '.$_POST["class"].':</h3></th></tr>
      <tr>
            <th scope="col">Flight_ID</th>
            <th scope="col">Airline_Name</th>
            <th scope="col">Economy fare</th>
            <th scope="col">Buisness_fare</th>
            <th scope="col">Dept_time</th>
            <th scope="col">Dept_date</th>
            <th scope="col">Arrival_time</th>
            <th scope="col">Arrival_date</th>
            <th scope="col"></th>
          </tr>
        </thead>
        ' ;
        while($rows=mysqli_fetch_assoc($res))
        {
          echo "
          <input type='hidden' name='class' value=$class />
          <input type='hidden' name='flight' value='{$rows['Flight_ID']}' />
          <tr><td>{$rows['Flight_ID']}</td>
           <td>{$rows['Airline_name']}</td> 
           <td>{$rows['Economy']}</td> 
           <td>{$rows['Buisness']}</td>
           <td>{$rows['dept_Time']}</td>
           <td>{$rows['dept_date']}</td>
           <td>{$rows['arrival_time']}</td>
           <td>{$rows['arrival_date']}</td>
           <td><input type='submit'name='submit' value='BOOK NOW!'/></td><tr>";
        }
    echo '</table>';
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
.sidenav {
  height: 100%;
  width: 160px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
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
      .sidenav {
  height: 100%;
  width: 160px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: transparent;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: BLACK;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
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
<body>
<div class="main">
      <nav id="side">
        <ul>
          <br>
          <br>
          <br>
          <br>
          <li><a href="searchflights.php">Search Flights</a></li>
          <li><a href="passenger info table.html">Book Ticket</a></li>
          <li><a href="customer.html">Enquiry</a></li>
        </ul>
      </nav>