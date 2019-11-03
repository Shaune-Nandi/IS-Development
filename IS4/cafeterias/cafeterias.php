<?php
include './../includes/connect.php';
include './../includes/wallet.php';
if ($_SESSION['customer_sid'] == session_id()) {
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="icon" href="./../images/logo/favicon.ico" type="image/ico">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./../css/cafeteria.css" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Londrina+Shadow' rel='stylesheet' type='text/css'>
    <title>Cafeterias</title>

    <style>
      h1 {
        font-family: 'Londrina Shadow', cursive;
        text-align: center;
        font-size: 75px;
        color: #000000;
        margin: 60px 0 0 0;
      }
    </style>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="./../home/index.php">
        <img src="./../images/logo/logo.png" class="img-fluid" width="30px"><strong>Strath Café</strong>
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
            <a class="nav-link" href="./../about/about.html">About</a>
          </li>
        </ul>
    </nav>
    <br>
    <div class="container">
      <div class="row">

        <!--LEFT-SIDE-->
        <div class="col-md-3 border rounded-left bg-light border-right-0">
          <br>
          <h3><i class="fas fa-user"></i> <?php echo $name; ?></h3>
          <p><?php echo $role; ?></p>
          <br>
          <hr><br>
          <a href="cafeterias.php">
            <div class="bg-light"><br>Order Food<br></div>
          </a>
          <hr>
          <a>
            <div class="bg-light" onclick="myFunction()"><br>View Orders<br></div>
            <div style="display: none;" id="myDIV">
              <ul>
                <li><a href="./../orders/orders.php">
                    <div class="bg-light">All</div>
                  </a></li>
                <?php
                  $sql = mysqli_query($con, "SELECT DISTINCT status FROM orders WHERE customer_id = $user_id;");
                  while ($row = mysqli_fetch_array($sql)) {
                    echo '<li><a href="./../orders/orders.php?status=' . $row['status'] . '"><div class="bg-light">' . $row['status'] . '</div></a>
                                      </li>';
                  }
                  ?>
              </ul>
            </div>
          </a>
          <hr>
          <a href="./../details/details.php">
            <div class="bg-light"><br>Profile<br></div>
          </a>
          <hr>
          <a href="./../authentication/logout.php">
            <div class="bg-light"><br>Logout<br></div>
          </a>
          <hr>
        </div>
        <!--END LEFT-SIDE-->









        <div class="col-md-9 border rounded-right bg-light">
          <h1><strong>AVAILABLE CAFETERIAS !</strong></h1>
          <hr>

          <a href="./strathmore.php">
            <div class="card">
              <div class="card-body">
                <center><img src="./../images/Beef-Stew-Ugali-1.jpg" alt="Strathmore Cafeteria" width="400px" /></center>
              </div>
              <div class="card-footer">
                <div class="name">
                  <p class="text-center">Strathmore Cafeteria</p>
                </div>
                <div class="descrptn">
                  <p class="text-center">Student's Center Ground Floor Cafeteria</p>
                </div>
              </div>
            </div>
          </a>

          <br>
          <hr><br>

          <a href="./pate.php">
            <div class="card">
              <div class="card-body">
                <center><img src="./../images/omena.jpg" alt="Pate Cafeteria" width="400px" /></center>
              </div>
              <div class="card-footer">
                <div class="name">
                  <p class="text-center">Pate Cafeteria</p>
                </div>
                <div class="descrptn">
                  <p class="text-center">Cafeteria in the auditorium basement</p>
                </div>
              </div>
            </div>
          </a>

          <br>
          <hr><br>

          <a href="./kilimanjaro.php">
            <div class="card">
              <div class="card-body">
                <center><img src="./../images/Beef-Stew-Ugali-1.jpg" alt="Kilimanjaro Cafeteria" width="400px" /></center>
              </div>
              <div class="card-footer">
                <div class="name">
                  <p class="text-center">Kilimanjaro Cafeteria</p>
                </div>
                <div class="descrptn">
                  <p class="text-center">Student's Center Rooftop cafeteria</p>
                </div>
              </div>
            </div>
          </a>
          <br><br>
        </div>
      </div>
    </div>

    <br>
    <hr><br><br><br>


    <!--footer-->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>StrathCafe</h2>
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

    <script>
      function myFunction() {
              var x = document.getElementById("myDIV");
              if (x.style.display === "none") {
                x.style.display = "block";
              } else {
                x.style.display = "none";
              }
            }
    </script>
  </body>

  </html>

<?php
} else {
  if ($_SESSION['admin_sid'] == session_id()) {
    header("location:./../admin/admin_home.php");
  } else {
    header("location:./../authentication/login.php");
  }
}
?>