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
        <title>Orders</title>

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
                    <a href="authentication/logout.php">
                        <div class="bg-light"><br>Logout<br></div>
                    </a>
                    <hr>
                </div>
                <!--END LEFT-SIDE-->

                <!--RIGHT-SIDE-->
                <div class="col-md-9 border rounded-right">
                    <h1><strong>ORDERS</strong></h1>
                    <hr>


                    <!--editableTable-->


                    <?php
                        if (isset($_GET['status'])) {
                            $status = $_GET['status'];
                        } else {
                            $status = '%';
                        }
                        $sql = mysqli_query($con, "SELECT * FROM orders WHERE customer_id = $user_id AND status LIKE '$status';;");

                        while ($row = mysqli_fetch_array($sql)) {
                            $status = $row['status'];
                            echo '<div class="card">
                                    <div class="card-body">
                              <p><strong>Order No: </strong> ' . $row['id'] . '</p>
                              <p><strong>Date: </strong> ' . $row['date'] . '</p>
                              <p><strong>Payment Type: </strong> ' . $row['payment_type'] . '</p>
                              <p><strong>Status: </strong> ' . ($status == 'Paused' ? 'Paused <a  data-position="bottom" data-delay="50" data-tooltip="Please contact administrator for further details." class="btn-floating waves-effect waves-light tooltipped cyan">    ?</a>' : $status) . '</p>
                              
                              ';
                            echo '
                                        <table class="table table-bordered">
                                            <thread>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Price</th>
                                            </tr>
                                        </thread>';
                            $order_id = $row['id'];
                            $sql1 = mysqli_query($con, "SELECT * FROM order_details WHERE order_id = $order_id;");
                            while ($row1 = mysqli_fetch_array($sql1)) {
                                $item_id = $row1['item_id'];
                                $sql2 = mysqli_query($con, "SELECT * FROM items WHERE id = $item_id;");
                                while ($row2 = mysqli_fetch_array($sql2)) {
                                    $item_name = $row2['name'];
                                }
                                echo '
                                        <tbody>
                                            <tr>
                                                <td>' . $item_name . '</td>
                                                <td>' . $row1['quantity'] . ' </td>
                                                <td>Ksh ' . $row1['price'] . '</td>
                                            <tr>
                                        
                                            ';
                                $id = $row1['order_id'];
                            }
                            echo '
                                        
                                    </tbody></table> <p>Total Amount
                                                <span><strong>Ksh ' . $row['total'] . '/=</strong></span></p>
                                            ';
                            if (!preg_match('/^Cancelled/', $status)) {
                                if ($status != 'Delivered') {
                                    echo '<form action="./../routers/cancel-order.php" method="post">
                                                <input type="hidden" value="' . $id . '" name="id">
                                                <input type="hidden" value="Cancelled by Customer" name="status">	
                                                <input type="hidden" value="' . $row['payment_type'] . '" name="payment_type">											
                                                <button class="btn btn-outline-primary w-100" type="submit" name="action">Cancel Order
                                                </button>
                                                </form><br>';
                                }
                            }echo '</div></div><br><br>';
                        }
                        ?>

                </div>
            </div><br>
        </div>
        <!--end container-->

        </section>
        <!-- END CONTENT -->
        </div>
        <!-- END WRAPPER -->

        </div>
        <!-- END MAIN -->
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
        <!--plugins.js - Some Specific JS codes for Plugin Settings-->
        <script type="text/javascript" src="js/plugins.min.js"></script>
        <!--custom-script.js - Add your own theme custom JS-->
        <script type="text/javascript" src="js/custom-script.js"></script>
        </div>
        </div>

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
        header("location:all-orders.php");
    } else {
        header("location:login.php");
    }
}
?>