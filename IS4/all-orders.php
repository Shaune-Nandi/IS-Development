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
        <title>All Orders</title>

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
            <div class="row">

                <!--LEFT-SIDE-->
                <div class="col-md-3 border rounded-left bg-light border-right-0">
                    <br>
                    <h3><i class=" fas fa-user"></i> <?php echo $name; ?></h3>
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

                <!--RIGHT-SIDE-->
                <div class="col-md-9 border rounded-right">
                    <h1><strong>ALL ORDERS</strong></h1>
                    <hr>

                    <!--editableTable-->



                    
                        

                        <?php
                            if (isset($_GET['status'])) {
                                $status = $_GET['status'];
                            } else {
                                $status = '%';
                            }
                            $sql = mysqli_query($con, "SELECT * FROM orders WHERE status LIKE '$status';");

                            while ($row = mysqli_fetch_array($sql)) {
                                $status = $row['status'];
                                $deleted = $row['deleted'];
                                echo '
                                <div class="card"><h5 class="card-title text-center bg-light border-bottom">
                              <p>Order ID: ' . $row['id'] . '</p>
                              <p>' . $row['date'] . '</p>
                            						  
                                <p><strong>Status:</strong> ' . ($deleted ? $status : '
                                    <form method="post" action="routers/edit-orders.php">
                                    <input type="hidden" value="' . $row['id'] . '" name="id">
                                    <select name="status">
                                        <option value="Yet to be delivered" ' . ($status == 'Yet to be delivered' ? 'selected' : '') . '>Yet to be delivered</option>
                                        <option value="Delivered" ' . ($status == 'Delivered' ? 'selected' : '') . '>Delivered</option>
                                        <option value="Cancelled by Admin" ' . ($status == 'Cancelled by Admin' ? 'selected' : '') . '>Cancelled by Admin</option>
                                        <option value="Paused" ' . ($status == 'Paused' ? 'selected' : '') . '>Paused</option>								
                                    </select>
                                    ');
                                    echo '</h5>';

                                

                                $order_id = $row['id'];
                                $customer_id = $row['customer_id'];
                                $sql1 = mysqli_query($con, "SELECT * FROM order_details WHERE order_id = $order_id;");
                                $sql3 = mysqli_query($con, "SELECT * FROM users WHERE id = $customer_id;");
                                while ($row3 = mysqli_fetch_array($sql3)) {
                                    echo '
							<p><strong>Ordered by: </strong>' . $row3['name'] . '</p><br>	
							' . ($row3['email'] == '' ? '' : '<p><strong>Email: </strong>' . $row3['email'] . '</p><br>') . '							
                            ';
                                }
                                echo '
                                <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Amount</th>
                                  </tr>
                                </thead>
                                <tbody>';
                                while ($row1 = mysqli_fetch_array($sql1)) {
                                    $item_id = $row1['item_id'];
                                    $sql2 = mysqli_query($con, "SELECT * FROM items WHERE id = $item_id;");
                                    while ($row2 = mysqli_fetch_array($sql2))
                                        $item_name = $row2['name'];
                                    echo '
                              <tr>
                                <td>' . $item_name . '</td>
                                <td>' . $row1['quantity'] . '</td>
                                <td>' . $row1['price'] . '</td>
                              </tr>
                            ';
                                }
                                echo '</tbody>
                                    </table>';
                                echo '
                                    <p><strong>Total: Ksh ' . $row['total'] . '</strong></p>';
                                if (!$deleted) {
                                    echo '<button class="btn btn-outline-primary" type="submit" name="action">Change Status
										</button><br>
										</form>';                                
                                        
                                }echo '</div>';echo '<br><hr><br>';
                            }
                            ?>

                    
                </div>
                <!-- END CONTENT -->
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
        <!--plugins.js - Some Specific JS codes for Plugin Settings-->
        <script type="text/javascript" src="js/plugins.min.js"></script>
        <!--custom-script.js - Add your own theme custom JS-->
        <script type="text/javascript" src="js/custom-script.js"></script>

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
    if ($_SESSION['customer_id'] == session_id()) {
        header("location:orders.php");
    } else {
        header("location:login.php");
    }
}
?>