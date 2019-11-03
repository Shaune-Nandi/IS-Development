<?php
include './../includes/connect.php';
include './../includes/wallet.php';
$total = 0;
if ($_SESSION['customer_sid'] == session_id()) {
  $result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
  while ($row = mysqli_fetch_array($result)) {
    $name = $row['name'];
    $contact = $row['contact'];
    $verified = $row['verified'];
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="icon" href="./../images/logo/favicon.ico" type="image/ico">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./../css/cafeteria.css" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Londrina+Shadow' rel='stylesheet' type='text/css'>
    <title>Place Order</title>

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

    <!-- START MAIN -->
    <div class="container">
      <div class="row">
        <!--LEFT-SIDE-->
        <div class="col-md-3 border rounded-left bg-light border-right-0">
          <br>
          <h3><i class="fas fa-user"></i> <?php echo $name; ?></h3>
          <p><?php echo $role; ?></p>
          <br>
          <hr><br>
          <a href="./../cafeterias/cafeterias.php">
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
          <h1><strong>ORDER DETAILS</strong></h1>
          <hr>
          <div class="card">
            <div class="card-body bg-light border-bottom">
              <center>
                <h3>Details</h3>
              </center>
            </div>
            <!--editableTable-->
            <div class="card-body">
              <?php
                echo '
                      <p><strong>Name:</strong> ' . $name . '</p>
                      <p><strong>Mobile:</strong> ' . $contact . '</p>';


                echo '
                  <table class="table table-bordered">
                    <thread>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                      </tr>
                    </thread>';
                foreach ($_POST as $key => $value) {
                  if ($value == '') {
                    break;
                  }
                  if (is_numeric($key)) {
                    $result = mysqli_query($con, "SELECT * FROM items WHERE id = $key");
                    while ($row = mysqli_fetch_array($result)) {
                      $price = $row['price'];
                      $item_name = $row['name'];
                      $item_id = $row['id'];
                    }
                    $price = $value * $price;
                    echo '
                            <tbody>
                              <tr>
                                <td>' . $item_id . '</td>
                                <td>' . $item_name . '</td>
                                <td>' . $value . '</td>
                                <td>Ksh. ' . $price . '</td>
                              </tr>';
                    $total = $total + $price;
                  }
                }
                echo '
                      <p></tbody></table><br>
                       Total Amount <span><strong>Ksh. ' . $total . ' /=</strong></span></p>
                      ';


                ?>
              <hr>
              <form class="formValidate" id="formValidate" method="post" action="./../orders/confirm-order.php" novalidate="novalidate">
                <label for="payment_type">Payment Type</label><br>
                <select id="payment_type" name="payment_type">
                  <option value="Cash On Delivery" selected>Cash on Delivery</option>
                  <option value="Wallet" <?php if (!$verified) echo 'disabled'; ?>>Credit</option>
                </select>
                <hr>
                <button class="btn btn-outline-primary w-100" type="submit" name="action">Submit
                </button>

                <?php
                  foreach ($_POST as $key => $value) {
                    if ($key == 'action' || $value == '') {
                      break;
                    }
                    echo '<input name="' . $key . '" type="hidden" value="' . $value . '">';
                  }
                  ?>
              </form>




            </div>
          </div><br><br>
        </div>
        <!-- END RIGHT SIDE-->
      </div><br><br>
    </div>


    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START FOOTER -->
    <footer class="page-footer">
      <div class="footer-copyright">
        <div class="container">
          <span>Copyright © 2017 <a class="grey-text text-lighten-4" href="#" target="_blank">Students</a> All rights reserved.</span>
          <span class="right"> Design alkjhgfdsand Developed by <a class="grey-text text-lighten-4" href="#">Students</a></span>
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
    <script type="text/javascript" src="js/plugins/formatter/jquery.formatter.min.js"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script type="text/javascript">
      $("#formValidate").validate({
        rules: {
          address: {
            required: true,
            minlength: 5
          },
          cc_number: {
            required: true,
            minlength: 16,
          },
          cvv_number: {
            required: true,
            minlength: 3,
          },
        },
        messages: {
          address: {
            required: "Enter a address",
            minlength: "Enter at least 5 characters"
          },
          cc_number: {
            required: "Please provide card number",
            minlength: "Enter at least 16 digits",
          },
          cvv_number: {
            required: "Please provide CVV number",
            minlength: "Enter at least 3 digits",
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
      $('#cc_number').formatter({
        'pattern': '{{9999}}-{{9999}}-{{9999}}-{{9999}}',
        'persistent': true
      });
      $('#cvv_number').formatter({
        'pattern': '{{9}}-{{9}}-{{9}}',
        'persistent': true
      });
      $('#payment_type').change(function() {
        if ($(this).val() === 'Cash On Delivery') {
          $("#cc_number").prop('disabled', true);
          $("#cvv_number").prop('disabled', true);
        }
        if ($(this).val() === 'Wallet') {
          $("#cc_number").prop('disabled', false);
          $("#cvv_number").prop('disabled', false);
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
  if ($_SESSION['admin_sid'] == session_id()) {
    header("location:admin-page.php");
  } else {
    header("location:login.php");
  }
}
?>