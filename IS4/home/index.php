<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" />
  <link href="./../css/styles.css" type="text/css" rel="stylesheet" />
  <link rel="icon" href="./../images/logo/favicon.ico" type="image/icon" />

  <title>Home</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="./../home/index.php">
      <img src="./../images/logo/logo.png" class="img-fluid" width="40px"><strong>StrathCafe</strong>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="./../home/index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./../cafeterias/cafeterias.php">Cafeterias</a>
        </li>

      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="./../authentication/login.php">
            <button class="btn btn-outline-light  my-2 my-sm-0" type="submit" id="log">Login</button>
          </a>
        </li>
        <li class="nav-item">
          <a href="./../registration/register.php">
            <button class="btn btn-outline-danger  my-2 my-sm-0" type="submit" id="log">Register</button>
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container-fluid banner">
    <div class="container" style="height: 500px;">
      <div class="row">

        <div class="col-md-12 caption" style="margin-top:200px;">

          <h1>StrathCafe</h1>
          <h2><strong>Are you hungry?</strong></h2>
          <p>
            Look no further, StrathCafe
            by the click of a button.
          </p>
          <center>
            <a href="./../cafeterias/cafeterias.php"><button class="btn btn-primary" type="submit">Order Now!</button></a>
          </center>
        </div>
      </div>
    </div>
  </div>

  <!---about-->
  <div class="spacer"></div>
  <div class="container" id="about">
    <div class="row">
      <div class="col-md-6 about">
        <h1>About Us</h1>
        <p>
          Let's eat!<br>
          Where else to get some if not StrathCafe?
        </p>
        <a href="./../about/about.html"><button class="btn btn-primary" type="submit">Read More</button></a>
      </div>


      <div class="col-md-6">
        <!------carousel-->
        <div id="multi-item" class="carousel testimonial-carousel slide carousel-multi-item" data-ride="carousel">
          <!--Slides-->
          <div class="carousel-inner" role="listbox">

            <!--First slide-->
            <div class="carousel-item active">
              <div class="col-md-12">
                <img src="./../images/fries1.jpg" class="img-fluid">
              </div>
            </div>
            <!--second slide-->
            <div class="carousel-item">
              <div class="col-md-12">
                <img src="./../images/chicken_stew.png" class="img-fluid">
              </div>
            </div>


            <!--Third slide-->
            <div class="carousel-item">
              <div class="col-md-12">
                <img src="./../images/hotdog.jpg" class="img-fluid">
              </div>
            </div>

            <!--Fourth slide-->
            <div class="carousel-item">
              <div class="col-md-12">
                <img src="./../images/spaghetti 2.jpg" class="img-fluid">
              </div>
            </div>
          </div>



        </div>
      </div>
    </div>
  </div>
  <!--end carousel-->

  <!--footer-->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>StrathCafe</h1>
          <img src="./../images/apple-store.svg" alt="" />
          <img src="./../images/playstore.png" height="40px" alt="" class="ml-4" />
        </div>
        <div class="col-md-3">
          <ul>
            <li><a href="./../about/about.html">About StrathCafe </a></li>
            <li><a href="./../cafeterias/cafeterias.php">Order Now</a></li>
            <li><a href="./../registration/registration.html">Sign Up</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <ul>
            <li>Get Help</li>
            <li>Read FAQS</li>
            <li></li>
            <li></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container" id="horizontal"></div>
    <div class="container" id="copyright">
      <div class="row">
        <div class="col-md-6">
          <p>Copyright &copy; 2019 StrathCafe All rights reserved</p>
        </div>
        <div class="col-md-6">
          <a href="https://twitter.com/strathu/"><i class="fa fa-twitter" style="font-size: 30px;padding: 12px"></i></a>
          <a href="https://www.instagram.com/strathmore.university/"><i class="fa fa-instagram" style="font-size: 30px;padding: 12px"></i>
            <a href="https://www.facebook.com/StrathmoreUniversity/"><i class="fa fa-facebook" style="font-size: 30px;padding: 12px"></i></a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <script src="./js/scripts.js"></script>
</body>

</html>