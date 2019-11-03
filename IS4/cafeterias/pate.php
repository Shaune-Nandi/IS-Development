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
    <title>Pate Cafeteria</title>

    <style>
      h1 {
        font-family: 'Londrina Shadow', cursive;
        text-align: center;
        font-size: 50px;
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



    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- MAIN PAGE-->
    <div class="container">
      <div class="row ">

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



        <!--RIGHT SIDE-->
        <div class="col-md-9 border rounded-right">
          <h1><strong>PATE CAFETERIA</strong></h1>
          <hr>
          <form class="formValidate" id="formValidate" method="post" action="./../orders/place-order.php" novalidate="novalidate">

            <div>
              <?php
                $result = mysqli_query($con, "SELECT * FROM items where not deleted AND cafeteria = 'Pate';");
                while ($row = mysqli_fetch_array($result)) {
                  echo '
                      <div class="card">
                        <div class="card-body">
                          <center><img src="./../' . $row["image"] . '" width="600px"/></center>
                        </div>
                        <div class="card-footer text-center">
                          <div><h4>' . $row["name"] . '</h4></div>
                          <div class="item-details">
                            <p><h4>KES ' . $row["price"] . '/=</h4></p>
                            <label id="quantity" for=' . $row["id"] . '><h5>Quantity: </h5></label>
                            <input id="quantity" name="' . $row['id'] . '" type="number" data-error=".errorTxt' . $row["id"] . '"><div class="errorTxt' . $row["id"] . '">
                          </div>
                          <a href="#order"><button class="btn btn-outline-primary col-md-3" type="button">OK</button></a> 
                        </div>
                        </div>
                      </div>
                      <br><br>
                    ';
                }
                ?>
            </div>

            <div>
              <button id="order" class="btn btn-primary col-md-12" type="submit" name="action">ORDER
              </button>
            </div>
            <br>
          </form>
          <!--END RIGHT-SIDE -->
        </div>
      </div>

      <br>

      <!--START FOOTER -->
      <footer>
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
      </footer>
      <!--END FOOTER-->
    </div>


    <!-- ================================================
    Scripts
    ================================================ -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
    <!--angularjs-->
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!-- data-tables -->
    <script type="text/javascript" src="js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/data-tables/data-tables-script.js"></script>

    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>

    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script type="text/javascript">
      $("#formValidate").validate({
            rules: {
              <?php
                $result = mysqli_query($con, "SELECT * FROM items where not deleted;");
                while ($row = mysqli_fetch_array($result)) {
                  echo $row["id"] . ':{
				min: 0,
				max: 10
				},
				';
                }
                echo '},';
                ?>
              messages: {
                <?php
                  $result = mysqli_query($con, "SELECT * FROM items where not deleted;");
                  while ($row = mysqli_fetch_array($result)) {
                    echo $row["id"] . ':{
				min: "Minimum 0",
				max: "Maximum 10"
				},
				';
                  }
                  echo '},';
                  ?>
                errorElement: 'div',
                errorPlacement: function(error, element) {
                  var placement = $(element).data('error');
                  if (placement) {
                    $(placement).append(error)
                  } else {
                    error.insertAfter(element);
                  }
                }
              });





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
    header("location:admin-page.php");
  } else {
    header("location:login.php");
  }
}
?>