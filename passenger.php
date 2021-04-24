
<?php
  session_start();
  if(($_SESSION["user"])==null)
     {
      header("location: login.php");
     }
  $showalert=false;
  $nameErr = $emailErr = $phoneErr= $adherr="";
   include 'connect.php';
   $f=0;
   $s=$_SESSION['seats'];
   if($_SERVER["REQUEST_METHOD"] == "POST")
    { 
    for ($i = 1; $i <= $s; $i++)  
    {   
    $name = $_POST["name$i"];
    $email =$_POST["email$i"];
    $phone =$_POST["phone$i"];
    $city =$_POST["city$i"];
    $postal =$_POST["zipcode$i"];
    $adhaar =$_POST["adhaar$i"];
    $state =$_POST["state$i"];
    $gender =$_POST["gender$i"];
    $dob =$_POST["dob$i"];
    $exists=false;
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed" ;
    } 
    else if (!preg_match("/^[0-9\-\(\)\/\+\s]*$/",$phone)) {
      $phoneErr = "Enter Valid Phone number" ;
    } 
    else{
        $sql = "INSERT INTO `passenger_info` ( `Aadhar_No`, `P_DOB`,`P_email`,`P_Name`,`P_gender`,`p_phone_no`,`state`,`city`,`pincode`) VALUES ('$adhaar', '$dob','$email','$name','$gender','$phone','$state','$city','$postal')";
        $sql1="UPDATE `passenger_info` SET `P_age` = year(CURRENT_DATE())-year(`P_DOB`) where Aadhar_No='$adhaar'";
        $result = mysqli_query($conn, $sql);
        mysqli_query($conn, $sql1);
        echo $result;
        if ($result){
            $showalert = true;
         }
         else
         echo("Error description: " . mysqli_error($conn));
    }
} 
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Ticket Booking Form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
body{
  background-image: url("https://media.cntraveler.com/photos/5a4e4dfd75ddab26e42d6603/16:9/w_2560%2Cc_limit/GettyImages-86146996.jpg");
  background-repeat:no-repeat;
  background-position: center;
  background-size: cover;
}
</style>
<body>
<body>
<div class="alert alert-success" role="alert">
            <p>You have successfuly entered your Information!</p>
            <br>
            <p> Click below button for payment👇</p>
            <div class="btn-block">
            <a href="payment.php" class="button">Payment</a>
           </div>
            <hr>
           </div>
</body>
</html>