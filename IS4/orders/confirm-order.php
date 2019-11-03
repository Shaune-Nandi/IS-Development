<?php
include './../includes/connect.php';
include './../includes/wallet.php';
$continue = 0;
$total = 0;
if ($_SESSION['customer_sid'] == session_id()) {
    if ($_POST['payment_type'] == 'Wallet') {
        $_POST['cc_number'] = str_replace('-', '', $_POST['cc_number']);
        $_POST['cc_number'] = str_replace(' ', '', $_POST['cc_number']);
        $_POST['cvv_number'] = (int) str_replace('-', '', $_POST['cvv_number']);
        $sql1 = mysqli_query($con, "SELECT * FROM wallet_details where wallet_id = $wallet_id");
        while ($row1 = mysqli_fetch_array($sql1)) {
            $card = $row1['number'];
            $cvv = $row1['cvv'];
            if ($card == $_POST['cc_number'] && $cvv == $_POST['cvv_number'])
                $continue = 1;
            else
                header("location:index.php");
        }
    } else
        $continue = 1;
}

$result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
while ($row = mysqli_fetch_array($result)) {
    $name = $row['name'];
    $contact = $row['contact'];
}

if ($continue) {
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
        <title>Confirm Order</title>
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

        <!-- RIGHT SIDE -->
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

                <!-- //////////////////////////////////////////////////////////////////////////// -->

                <!--start container-->
                <div class="col-md-9 border rounded-right">
                    <h1><strong>CONFIRM ORDER</strong></h1>
                    <hr>
                    <div class="card">
                        <div class="card-body bg-light border-bottom">
                            <center>
                                <h3>Receipt</h3>
                            </center>
                        </div>

                        <div class="card-body">

                            <?php
                                echo '
                                        <p><strong>Name: </strong>' . $name . '</p>
                                        <p><strong>Mobile: </strong> ' . $contact . '</p>	
                                        <p><strong>Payment Type: </strong> ' . $_POST['payment_type'] . '</p>			
                                        ';
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
                                    if (is_numeric($key)) {
                                        $result = mysqli_query($con, "SELECT * FROM items WHERE id = $key");
                                        while ($row = mysqli_fetch_array($result)) {
                                            $price = $row['price'];
                                            $item_name = $row['name'];
                                            $item_id = $row['id'];
                                        }
                                        $price = $value * $price;
                                        echo '
                                            <tr>
                                                <td>' . $item_id . ' </td>
                                                <td>' . $item_name . '</td>
                                                <td>' . $value . ' </td>
                                                <td>Ksh ' . $price . '</td>
                                            </tr>
                                        ';
                                        $total = $total + $price;
                                    }
                                }
                                echo '
        
                                        <p></tbody></table><br>Total Amount
                                        <span><strong>Ksh ' . $total . '/=</strong></span></p>';

                                if (!empty($_POST['description']))
                                    echo '<li class="collection-item avatar"><p><strong>Note: </strong>' . htmlspecialchars($_POST['description']) . '</p></li>';

                                if ($_POST['payment_type'] == 'Wallet')
                                    echo '
                                                        <a href="#" class="collection-item">
                                                            <div class="row"><div class="col s7">Current Balance</div><div class="col s3">' . $balance . '</div></div>
                                                        </a>
                                                        <a href="#" class="collection-item active">
                                                            <div class="row"><div class="col s7">Balance after purchase</div><div class="col s3">' . ($balance - $total) . '</div></div>
                                                        </a>
';
                                ?>
                            <form action="./../routers/order-router.php" method="post">
                                <?php
                                    foreach ($_POST as $key => $value) {
                                        if (is_numeric($key)) {
                                            echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
                                        }
                                    }
                                    ?>
                                <input type="hidden" name="payment_type" value="<?php echo $_POST['payment_type']; ?>">
                                <input type="hidden" name="address" value="<?php echo htmlspecialchars($_POST['address']); ?>">
                                <?php if (isset($_POST['description'])) {
                                        echo '<input type="hidden" name="description" value="' . htmlspecialchars($_POST['description']) . '">';
                                    } ?>
                                <?php if ($_POST['payment_type'] == 'Wallet') echo '<input type="hidden" name="balance" value="<?php echo ($balance-$total);?>">'; ?>
                                <input type="hidden" name="total" value="<?php echo $total; ?>">
                                <div class="input-field col s12">
                                    <button class="btn btn-outline-primary w-100" type="submit" name="action" 
                                    <?php
                                        if ($_POST['payment_type'] == 'Wallet') {
                                            if ($balance - $total < 0) {
                                                echo 'disabled
                                                    You dont have enough money to make the purchase
                                                ';
                                            }
                                        }
                                    ?>
                                    >Confirm Order
                                    </button>
                                </div>
                            </form><br>
                        </div>
                    </div><br>
                </div>
                <!--END OF RIGHT SIDE-->
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