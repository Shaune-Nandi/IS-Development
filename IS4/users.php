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
    <title>Users</title>

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

    <!-- START MAIN -->
    <div class="container">
      <div class="rowr">

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
                  while ($row = mysqli_fetch_array($sql)) {
                    echo '<li><a href="all-orders.php?status=' . $row['status'] . '">' . $row['status'] . '</a>
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


        <!-- RIGHT SIDE -->
        <div class="col-md-9 border rounded-right">


          <div class="card" style="width: 18rem;">
          <h5 class="card-title">Card title</h5>
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>







          <h1><strong>USERS</strong></h1>
          <hr>
          <form class="formValidate" id="formValidate1" method="post" action="routers/user-router.php" novalidate="novalidate">
              <div>

                    <?php
                      $result = mysqli_query($con, "SELECT * FROM users");
                      while ($row = mysqli_fetch_array($result)) {
                        echo '<div class="card"><div class="card-title text-center bg-light">';
                        echo '<h5>' . $row["name"] . '</h5>';
                        echo '<p>' . $row["email"] . '</p></div>';
                        echo '<div class="card-body">';
                        echo '<p>' . $row["contact"] . '</p>';
                        echo '<p><select name="' . $row['id'] . '_role">
                      <option value="Administrator"' . ($row['role'] == 'Administrator' ? 'selected' : '') . '>Administrator</option>
                      <option value="Customer"' . ($row['role'] == 'Customer' ? 'selected' : '') . '>Customer</option>
                    </select></p>';
                        echo '<p><select name="' . $row['id'] . '_verified">
                      <option value="1"' . ($row['verified'] ? 'selected' : '') . '>Verified</option>
                      <option value="0"' . (!$row['verified'] ? 'selected' : '') . '>Not Verified</option>
                    </select></p>';
                        echo '<p><select name="' . $row['id'] . '_deleted">
                      <option value="1"' . ($row['deleted'] ? 'selected' : '') . '>Disable</option>
                      <option value="0"' . (!$row['deleted'] ? 'selected' : '') . '>Enable</option>
                    </select></p>';
                        $key = $row['id'];
                        $sql = mysqli_query($con, "SELECT * from wallet WHERE customer_id = $key;");
                        if ($row1 = mysqli_fetch_array($sql)) {
                          $wallet_id = $row1['id'];
                          $sql1 = mysqli_query($con, "SELECT * from wallet_details WHERE wallet_id = $wallet_id;");
                          if ($row2 = mysqli_fetch_array($sql1)) {
                            $balance = $row2['balance'];
                          }
                        }
                        echo '<p><label for="balance">Credit Balance</label><input id="balance" name="' . $row['id'] . '_balance" value="' . $balance . '" type="number" data-error=".errorTxt01"><div class="errorTxt01"></p>';
                      echo '</div></div></div><br><hr><br>';
                      }
                      ?>
              </div>
                <button class="btn btn-outline-primary w-100" type="submit" name="action">Modify
                </button>
                <br><br><hr>
          </form>
          <form class="formValidate" id="formValidate" method="post" action="routers/add-users.php" novalidate="novalidate">
              <div class="col s12 m4 l3">
                <h4 class="header">Add User</h4>
              </div>
              <div>
                <table>
                  <thead>
                    <tr>
                      <th data-field="name">Username</th>
                      <th data-field="name">Password</th>
                      <th data-field="name">Name</th>
                      <th data-field="price">Email</th>
                      <th data-field="price">Phone number</th>
                      <th data-field="price">Address</th>
                      <th data-field="price">Role</th>
                      <th data-field="price">Verified</th>
                      <th data-field="price">Enable</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                      echo '<tr><td><label for="username">Username</label><input id="username" name="username" type="text" data-error=".errorTxt02"><div class="errorTxt02"></div></td>';
                      echo '<td><label for="password">Password</label><input id="password" name="password" type="password" data-error=".errorTxt03"><div class="errorTxt03"></div></td>';
                      echo '<td><label for="name">Name</label><input id="name" name="name" type="text" data-error=".errorTxt04"><div class="errorTxt04"></div></td>';
                      echo '<td><label for="email">Email</label><input id="email" name="email" type="email"></td>';
                      echo '<td><label for="contact">Phone number</label><input id="contact" name="contact" type="number" data-error=".errorTxt05"><div class="errorTxt05"></div></td>';
                      echo '<td><label for="address">Address</label><input id="address" name="address" type="text" data-error=".errorTxt06"><div class="errorTxt06"></div></td>';
                      echo '<td><select name="role">
                      <option value="Administrator">Administrator</option>
                      <option value="Customer" selected>Customer</option>
                    </select></td>';
                      echo '<td><select name="verified">
                      <option value="1">Verified</option>
                      <option value="0" selected>Not Verified</option>
                    </select></td>';
                      echo '<td><select name="deleted">
                      <option value="1">Disable</option>
                      <option value="0" selected>Enable</option>
                    </select></td></tr>';
                      ?>
                  </tbody>
                </table>
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
    <!-- END MAIN -->



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


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- ================================================
    Scripts
    ================================================ -->


    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
    <!--angularjs-->
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>


    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js">
      $("#formValidate").validate({
        rules: {
          username: {
            required: true,
            minlength: 5,
          },
          password: {
            required: true,
            minlength: 5,
          },
          name: {
            required: true,
            minlength: 5,
          },
          contact: {
            required: true,
            minlength: 4,
          },
          address: {
            minlength: 10,
          },
          balance: {
            required: true,
          },
        },
        messages: {
          username: {
            required: "Enter a username",
            minlength: "Enter at least 5 characters"
          },
          password: {
            required: "Provide a prove",
            minlength: "Password must be atleast 5 characters long",
          },
          name: {
            required: "Please provide CVV number",
            minlength: "Enter at least 5 characters",
          },
          contact: {
            required: "Please provide card number",
            minlength: "Enter at least 4 digits",
          },
          address: {
            minlength: "Address must be atleast 10 characters long",
          },
          balance: {
            required: "Please provide a balance.",
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