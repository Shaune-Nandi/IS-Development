<?php
include 'includes/connect.php';


if ($_SESSION['admin_sid'] == session_id()) {
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="icon" href="./../logo/favicon.ico" type="image/ico">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./../css/cafeteria.css" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Londrina+Shadow' rel='stylesheet' type='text/css'>
    <title>Home</title>

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
      <a class="navbar-brand" href="#">
          <img src="./../logo/logo.png" class="img-fluid" width="30px"><strong>Strath Café</strong>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./../about.html">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contacts</a>
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
          <hr>
          <a href="admin-page.php">
            <div class="bg-light"><br>Menus<br></div>
          </a>
          <hr>
          <a>
            <div class="bg-light" onclick="myFunction()"><br>View Orders<br></div>
            <div style="display: none;" id="myDIV">
              <ul>
                <li><a href="orders.php">
                    <div class="bg-light">All</div>
                  </a></li>
                <hr>
                <?php
									$sql = mysqli_query($con, "SELECT DISTINCT status FROM orders;");
									while($row = mysqli_fetch_array($sql)){
                                    echo '<li><a href="all-orders.php?status='.$row['status'].'">'.$row['status'].'</a>
                                    </li>';
									}
									?>
              </ul>
            </div>
          </a>
          <hr>
          <a href="users.php">
            <div class="bg-light"><br>All Users<br></div>
          </a>
          <hr>
          <a href="routers/logout.php">
            <div class="bg-light"><br>Logout<br></div>
          </a>
          <hr>
        </div>
        <!--END LEFT-SIDE-->





        <!-- START CONTENT -->
        <!--RIGHT-SIDE-->
        <div class="col-md-9 border rounded-right">
          <h1><strong>MENU</strong></h1>
          <hr>
          <div class="container">
            <form class="formValidate" id="formValidate" method="post" action="routers/menu-router.php" enctype="mulitipart/form-data" novalidate="novalidate">
              <div>
                <?php
                  $result = mysqli_query($con, "SELECT * FROM items");
                  while ($row = mysqli_fetch_array($result)) {
                    echo '<div class="container">
                      <div class="col-md-5">
                        <img src="' . $row["image"] . '" width="200px"><br>
                            <input value="' . $row["image"] . '" id="' . $row["id"] . '_image" name="' . $row['id'] . '_image" type="file"><br></div>';
                      
                      
                        echo '<div class="col-md-5"><label for="' . $row["id"] . '_name">Name</label>';
                        echo '<input value="' . $row["name"] . '" id="' . $row["id"] . '_name" name="' . $row['id'] . '_name" type="text"' . $row["id"] . '"><br>';
                        echo '<label for="' . $row["id"] . '_price">Price</label>';
                        echo '<input value="' . $row["price"] . '" id="' . $row["id"] . '_price" name="' . $row['id'] . '_price" type="text"' . $row["id"] . '"><br>';
                        echo '<label for="' . $row["id"] . '_cafeteria">Cafeteria</label>';
                        echo '<input value="' . $row["cafeteria"] . '" id="' . $row["id"] . '_cafeteria" name="' . $row['id'] . '_cafeteria" type="text"' . $row["id"] . '"><br>';

                        echo '';
                        if ($row['deleted'] == 0) {
                          $text1 = 'selected';
                          $text2 = '';
                        } else {
                          $text1 = '';
                          $text2 = 'selected';
                        }
                        echo '
                            <select name="' . $row['id'] . '_hide">
                            <option value="1"' . $text1 . '>Available</option>
                            <option value="2"' . $text2 . '>Not Available</option>
                            </select>
                          </div>
                      </div>';
                    echo '<hr>';
                  }
                  ?>

              </div>
              <div class="input-field col s12">
                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Modify
                  <i class="mdi-content-send right"></i>
                </button>
              </div>
<hr>
            </form>
            <form class="formValidate" id="formValidate1" method="post" action="routers/add-item.php" enctype="multipart/form-data" novalidate="novalidate">
                <div>
                      <?php
                        echo '<input type="file" name="file"><br>';
                        echo '<label for="name">Name</label>';
                        echo '<input id="name" name="name" type="text" data-error=".errorTxt01"><br>';
                        echo '<label for="price" class="">Price</label>';
                        echo '<input id="price" name="price" type="text" data-error=".errorTxt02"><br>';
                        ?>
                </div>
                <div class="input-field col s12">
                  <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Add
                    <i class="mdi-content-send right"></i>
                  </button>
                </div>
            </form>
            <div class="divider"></div>

          </div>
        </div>
      </div>
    </div>


    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START FOOTER -->
    <footer class="page-footer">
      <div class="footer-copyright">
        <div class="container">
          <span>Copyright © 2017 <a class="grey-text text-lighten-4" href="#" target="_blank">Students</a> All rights reserved.</span>
          <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="#">Students</a></span>
        </div>
      </div>
    </footer>
    <!-- END FOOTER -->



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
                $result = mysqli_query($con, "SELECT * FROM items");
                while ($row = mysqli_fetch_array($result)) {
                  echo $row["id"] . '_name:{
				required: true,
				minlength: 5,
				maxlength: 20 
				},';
                  echo $row["id"] . '_price:{
				required: true,	
				min: 0
				},';
                }
                echo '},';
                ?>
              messages: {
                <?php
                  $result = mysqli_query($con, "SELECT * FROM items");
                  while ($row = mysqli_fetch_array($result)) {
                    echo $row["id"] . '_name:{
				required: "Ener item name",
				minlength: "Minimum length is 5 characters",
				maxlength: "Maximum length is 20 characters"
				},';
                    echo $row["id"] . '_price:{
				required: "Ener price of item",
				min: "Minimum item price is Rs. 0"
				},';
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
    </script>
    <script type="text/javascript">
      $("#formValidate1").validate({
        rules: {
          name: {
            required: true,
            minlength: 5
          },
          price: {
            required: true,
            min: 0
          },
        },
        messages: {
          name: {
            required: "Enter item name",
            minlength: "Minimum length is 5 characters"
          },
          price: {
            required: "Enter item price",
            minlength: "Minimum item price is Rs.0"
          },
        },
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
    </script>

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
  if ($_SESSION['customer_sid'] == session_id()) {
    header("location:index.php");
  } else {
    header("location:login.php");
  }
}
?>