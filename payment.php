<?php
  require 'connect.php';
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
    <style>
      body{
        background-image: url("");
        background-repeat: no-repeat;
        background-position: center;
        background-size:cover,contain;
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
      #side a, .dropdown-btn {
        padding: 6px 8px 6px 0px;
        text-decoration: none;
        font-size: 20px;
        color: white;
        display: block;
        border: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        outline: none;
      }
      #side a:hover, .dropdown-btn:hover {
        color: yellow;
      }
      .sticky {
        position: fixed;
        top: 0;
        width: 100%;
      }
      .sticky + .content {
        padding-top: 60px;
      }
      #menu{
        width:50px;
        position: fixed;
        right: 65px;
        top:35px;
        z-index:2;
        cursor:pointer;
      }
      #side{
        width:250px;
        height:700px;
        position: fixed;
        right:-250px;
        top:0;
        background-color:rgba(0,0,0,0.2);
        z-index: 2;
        transition: 2s;
        overflow-y: scroll;
      }
      li {
        list-style-type: none;
        font-size: 16pt;
      }
      nav ul li{
        list-style: none;
        margin:50px 20px;
      }
      nav ul li a{
        text-transform: uppercase;
        text-decoration: none;
        color: white;
        text-align: right;
      }
      .main {
        margin-left: 60px; /* Same as the width of the sidenav */
        font-size: 28px; /* Increased text to enable scrolling */
        padding: 0px 10px;
        margin-right: 80px;
      }
    </style>
     
  </head>
  <body>
    <?php
      $query ="SELECT FLight_ID departure_destination arrival_destination vacant_seats from airline "
    ?>
    <div id="navbar">
      <div class="container">
        <img src="https://5.imimg.com/data5/TK/AD/MY-36130657/flight-booking-500x500.png" class="img-fluid" width="171.2" height="100" style="float:left">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;logout</a></li>
        </ul>
      </div>
    </div>
    <nav id="side">
      <ul>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <li><a href="search flights.html">Search Flights</a></li>
        <li><a href="passenger info table.html">Book Ticket</a></li>
        <li><a href="customer.html">Enquiry</a></li>
      </ul>
    </nav>
    <img style="top: 120px;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTB5nWJeJStVSln4FEFOjNFF-AWjHE7OhgvYTu4mXG9xQdekA34VR3RXu0o7PJn3EEEJjo&usqp=CAU" style="width: 50px;"id="menu">
    <div class="row container">
      <div class="col-xs-8 container">
        <div class="container-fluid" style="padding-right: 50px; padding-left: 50px;">
          <div class="panel" style="left: 34px;">
            <div class="panel-heading">
              <h2><b>Payment Details</b></h2>
            </div>
            <div class="panel-body">
              <form action="ticket.php" method="POST">
                <div class="form-group">
                  <label for="Bank_Name">Bank Name</label> <br>
                  <select class="form-control" aria-label="slect bank" name="BankName">
                    <option selected value="" disabled> </option>
                    <option value="sbi">SBI</option>
                    <option value="hdfc">HDFC</option>
                    <option value="icici">ICICI</option>
                    <option value="axis">Axis</option>
                    <option value="kotak">Kotak</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="Account_Number">Account Number</label> <br>
                  <input type="number" placeholder="" class="form-control" name="AccountNumber">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-4 container">
        <div class="container-fluid panel-margin">
          <h2><b>Billing Details</b></h2>
          <br>
          <br>
          <br>
          <table class="table table-hover">
            <tr>
              <th>flight number</th>
              <td><?php echo $_POST['flight']?></td>
            </tr>
            <tr>
              <th>From</th>
              <td></td>
            </tr>
            <tr>
              <th>To</th>
              <td></td>
            </tr>
            <tr>
              <th>Charges</th>
              <td></td>
            </tr>
          </table>
        </div>
      </div>
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
      </script> 
  </body>  
</html>