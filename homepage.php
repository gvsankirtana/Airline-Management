<?php
session_start();

?>

<!doctype html>
 
<html lang="en">
  <head>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="homepage.css">
    <title>Airplane Management!</title>
  </head>
  <body>
    <h1>Airplane Management!</h1>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive" style="font-size:30px;">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
        </li>        &nbsp;        &nbsp;
        <?php 
        if(($_SESSION["user"])==null)
     { ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        &nbsp;        &nbsp;
        <li class="nav-item">
          <a class="nav-link" href="signup.php">Signup</a>
        </li>        &nbsp;        &nbsp;
        <?php } ?>

      <?php 
        if(($_SESSION["user"])!=null)
     { ?>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>        &nbsp;        &nbsp;
      <?php } ?>
      </ul>
      <br>
      <br>
    </div>
  </div>
</nav>

<header>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <!-- Slide One - Set the background image for this slide in the line below -->
      <div class="carousel-item active" style="background-image: url('https://monroeaerospace.com/blog/wp-content/uploads/2019/08/airplane-landing-lights-874x452.jpg')">
        <div class="carousel-caption d-none d-md-block">
          <h2 class="display-4" style="font-weight:bold;color:yellow;background-color:black;">WELCOME TO ONLINE AIRPLANE BOOKING</h2>
          <p class="lead">You need to have an account to enjoy our services!</p>
        </div>
      </div>
      <!-- Slide Two - Set the background image for this slide in the line below -->
      <div class="carousel-item" style="background-image: url('https://4.bp.blogspot.com/-InDD3Hm_bhU/XB4_TK3TT7I/AAAAAAAAAJ4/r5tUeCOqq1MTchFh7D7pWdf582A4qYIIwCEwYBhgL/s1600/Businesswoman-working-at-a-computer-1280x720.jpg')">
        <div class="carousel-caption d-none d-md-block">
        <h2 class="display-4" style="font-weight:bold;color:yellow;background-color:black;">CUSTOMER SERVICE IS OUR FIRST AND ATMOST PRIORITY</h2>
        </div>
      </div>
      <!-- Slide Three - Set the background image for this slide in the line below -->
      <div class="carousel-item" style="background-image: url('https://1.bp.blogspot.com/-GWl5F8P4t-8/XB4_VV4VE5I/AAAAAAAAAKE/SmHRzas-LpMpDBoLn6otR9AznVsr6L7OgCEwYBhgL/s1600/t1larg.africa.cnn.jpg')">
        <div class="carousel-caption d-none d-md-block">
        <h2 class="display-4" style="font-weight:bold;color:yellow;background-color:black;">21 YEARS OF EXPERTISE IN RUNNING FLIGHTS</h2>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
  </div>
</header>

<!-- Page Content -->
<section class="py-5 text-center">
      <div class="container"> 
        <h2 class="text-center">Our Services</h2>
        <p class="text-muted mb-5 text-center">There are many variations of passengers leading to various needs. We promise to fulfill them all.</p>
        <div class="row">
          <div class="col-sm-6 col-lg-4 mb-3">
            <svg class="lnr text-primary services-icon">
              <use xlink:href="#lnr-magic-wand"></use>
            </svg>
            <h6>Be a registered user to enjoy our unlimited services</h6>
            <p class="text-muted">Sign up as a customer.Its absolutely free so why not?</p>
          </div>
          <div class="col-sm-6 col-lg-4 mb-3">
            <svg class="lnr text-primary services-icon">
              <use xlink:href="#lnr-heart"></use>
            </svg>
            <h6>You can book flights now its all a button away.</h6>
            <p class="text-muted">No more standing in long queues to book flight tickets with confusion.</p>
          </div>
          <div class="col-sm-6 col-lg-4 mb-3">
            <svg class="lnr text-primary services-icon">
              <use xlink:href="#lnr-rocket"></use>
            </svg>
            <h6>We have 24/7 customer service all for you</h6>
            <p class="text-muted">Our customer service employess are always eager to connect with you for feedback ,queries and complaints.</p>
          </div>
        
        </div>
      </div>
</section>
<section class="main">
<div class="container mt-4">
    <h1 class="text-center mb-4 p-4 text-secondary">From The Blog</h1>
      <div class="row">

   <div class="card-columns">
  <div class="card shadow border-0">
    <img class="card-img-top" src="https://4.bp.blogspot.com/-InDD3Hm_bhU/XB4_TK3TT7I/AAAAAAAAAJ4/r5tUeCOqq1MTchFh7D7pWdf582A4qYIIwCEwYBhgL/s1600/Businesswoman-working-at-a-computer-1280x720.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">I have used this site to book tickets in India and its amazing.</h5>
      <p class="card-text">The advantages are numerous.</p>
    </div>
  </div>
  <div class="card shadow border-0  p-3">
    <blockquote class="blockquote mb-0 card-body">
      <p>This is the fastest site i have seen in my life</p>
      <footer class="blockquote-footer">
        <small class="text-muted">
          Ram Kumar<cite title="Source Title">Forge</cite>
        </small>
      </footer>
    </blockquote>
  </div>
  <div class="card shadow border-0">
    <img class="card-img-top" src="https://4.bp.blogspot.com/-InDD3Hm_bhU/XB4_TK3TT7I/AAAAAAAAAJ4/r5tUeCOqq1MTchFh7D7pWdf582A4qYIIwCEwYBhgL/s1600/Businesswoman-working-at-a-computer-1280x720.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Such a user friendly site</h5>
      <p class="card-text">This is such a user friendly site</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>

</div>
</div>
   </div>
   </section>
   
   <!-- Header -->
<header class="bg-primary text-center py-5 mb-4">
  <div class="container">
    <h1 class="font-weight-light text-white">Meet the Team</h1>
  </div>
</header>

<!-- Page Content -->
<div class="container">
  <div class="row">
    <!-- Team Member 1 -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-0 shadow">
        <img src="https://source.unsplash.com/9UVmlIb0wJU/500x350" class="card-img-top" alt="...">
        <div class="card-body text-center">
          <h5 class="card-title mb-0">Krithikha Balamurugan</h5>
          <div class="card-text text-black-50">U19CS076</div>
        </div>
      </div>
    </div>
    <!-- Team Member 2 -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-0 shadow">
        <img src="https://source.unsplash.com/9UVmlIb0wJU/500x350" class="card-img-top" alt="...">
        <div class="card-body text-center">
          <h5 class="card-title mb-0">Sankirtana GV</h5>
          <div class="card-text text-black-50">U19CS068</div>
        </div>
      </div>
    </div>
    <!-- Team Member 3 -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-0 shadow">
        <img src="https://source.unsplash.com/sNut2MqSmds/500x350" class="card-img-top" alt="...">
        <div class="card-body text-center">
          <h5 class="card-title mb-0">Mahitha Gurrala</h5>
          <div class="card-text text-black-50">U19CS066</div>
        </div>
      </div>
    </div>
    
  </div>
  <!-- /.row -->

</div>

<div class="container">
    <div class="row">
         <div class="col-md-8">
        <blockquote class="blockquote text-center mb-0">
          <svg class="lnr text-muted quote-icon pull-left">
            <use xlink:href="#lnr-heart">                                       
          </use></svg>
          <p class="mb-0">Keep in touch with us!</p>
          <footer class="blockquote-footer">Airport Management<br>
            <cite title="Source Title">airportmanagement@gmail.com</cite>
          </footer>
        </blockquote>
        </div>
        
</a></div>
        </div>
        
      </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
      <script src="https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>

  </body>
</html>