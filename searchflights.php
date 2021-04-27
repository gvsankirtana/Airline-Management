<?php 
     session_start();
     if(($_SESSION["user"])==null)
     {
      header("location: login.php");
     }

?>
<!DOCTYPE html>
<html>
<head>
  <title>Search Flights</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="searchflights.css" rel="stylesheet">
    <style>
    body {
      font-family: "Lato", sans-serif;
      background-image: url("https://www.thephotoforum.com/attachments/thousand_steps3-jpg.95195/");
      background-repeat: no-repeat;
      background-size: cover;
    }
    </style>
</head>
<style>
    body {
      font-family: "Lato", sans-serif;
      background-image: url("https://www.thephotoforum.com/attachments/thousand_steps3-jpg.95195/");
      background-repeat: no-repeat;
      background-size: cover;
    }
    </style>
<body>
<div id="navbar">
		<div class="container">
			<img src="https://5.imimg.com/data5/TK/AD/MY-36130657/flight-booking-500x500.png" class="img-fluid" width="171.2" height="100" style="float:left">
			<ul class="nav navbar-nav navbar-right">
      <li style="top: 24px;"><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php print_r($_SESSION["user"]);?></a></li>
			</ul>
		</div>
	</div>
  <div class="main">
    <nav id="side"> 
      <ul>
        <br><br><br><br><br><br><br><br>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="searchflights.php">Book Ticket</a></li>
        <li><a href="enquiry.php">Enquiry</a></li>
        <li style="top: 24px;"><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;logout</a></li>
      </ul>
    </nav>
    <img src="https://cdn1.iconfinder.com/data/icons/mobile-device/512/settings-option-configurate-gear-blue-round-512.png" style="width: 50px; top: 120px" id="menu">
    <div class="testbox">
      <form action="search_result.php" method="post">
        <!--<div class="banner">
        </div>-->
        <div class="item">
          <h2><center>Filter Flights</center></h2>
          <label for="fcity">FROM:</label>
          <select name="fcity" id="fcity"  class="form-control">
            <option value="Hyderabad">Hyderabad</option>
            <option value="Delhi">Delhi </option>
            <option value="Shimla">Shimla</option>
            <option value="Chennai">Chennai</option>
            <option value="Lucknow">Lucknow </option>
            <option value="Allahabad">Allahabad</option>
            <option value="Bengaluru">Bengaluru</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Thiruvananthapuram">Thiruvananthapuram</option>
            <option value="Kolkata">Kolkata </option>
            <option value="Jaipur">	Jaipur</option>
            <option value="Surat">Surat</option>
          </select>
        </div>
        <div class="item">
          <label for="tcity">TO:</label>
          <select name="tcity" id="tcity"  class="form-control">
            <option value="Delhi">Delhi </option>
            <option value="Hyderabad">Hyderabad</option>
            <option value="Shimla">Shimla</option>
            <option value="Chennai">Chennai</option>
            <option value="Lucknow">Lucknow </option>
            <option value="Allahabad">Allahabad</option>
            <option value="Bengaluru">Bengaluru</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Thiruvananthapuram">Thiruvananthapuram</option>
            <option value="Kolkata">Kolkata </option>
            <option value="Jaipur">	Jaipur</option>
            <option value="Surat">Surat</option>
          </select>
        </div>
        <div class="question">
          <p>Class</p>
          <div class="form-check">
            <div class="left">
              <input type="radio" name="class" value="Business" style="width: 13px;height: 13px;">
              <label class="form-check-label">Business</label>
            </div> 
            <div class="">
              <input type="radio" name="class" value="Economy"style="width: 13px;height: 13px;" checked>
              <label class="form-check-label">Economy</label>
            </div>
          </div> <br>
        </div>
          <div class="day-visited">
            DATE OF TRAVEL :
            <input type="date" name="traveldate"  min="2021-04-26" required/>
            <div class="seats">TOTAL PASSENGERS:
              <input type="number" name="seats" min=1 required/>
            </div>
            <div class="btn-block">
              <input type="submit" value="Search Flights"/>
            </div>
          </div>
        </div>
      </form>
    </div>
    <script>
      var menu=document.getElementById("menu");
      var side=document.getElementById("side");
      side.style.right="-250px";
      menu.onclick=function(){
        if(side.style.right=="-250px"){
          side.style.right="0px"
        }
        else{
          side.style.right="-250px"
        }
      }
      var scroll = new SmoothScroll('a[href*="#"]');
      window.onscroll = function() {myFunction()};
      var navbar = document.getElementById("navbar");
      var sticky = navbar.offsetTop;
      function myFunction() {
        if (window.pageYOffset >= sticky) {
          navbar.classList.add("sticky")
        }
        else {
          navbar.classList.remove("sticky");
        }
      }
    </script>
  </body>
</html> 
