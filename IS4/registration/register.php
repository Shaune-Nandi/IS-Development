<?php
session_start();
if (isset($_SESSION['admin_sid']) || isset($_SESSION['customer_sid'])) {
  header("location:./../cafeterias/cafeterias.php");
} else {
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
    <title>Registration</title>

  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="./../home/index.php">
        <img src="./../images/logo/logo.png" class="img-fluid" width="30px"><strong>StrathCafe</strong>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="./../home/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./../cafeterias/cafeterias.php">Cafeterias</a>
          </li>
        </ul>

        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="./../authentication/login.php"><button class="btn btn-outline-light my-2 my-sm-0" type="submit" id="log">
                Login
              </button></a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container rounded border border-dark" style="margin-top:50px; margin-bottom:50px;">
      <div class="container">
        <div class="row">
          <div class="col-md-1 bg-primary">
          </div>

          <div class="col-md-11">
            <form class="formValidate" id="formValidate" method="post" action="./../registration/register_process.php" novalidate="novalidate" class="col s12">
              <h1>Register</h1>
              <hr>
              <div class="form-group">
                <label for="username" class="center-align">Admission Number:</label>
                <input name="username" class="form-control" id="username" type="number">
              </div>
              <div class="form-group">
                <label for="name" class="center-align">First Name:</label>
                <input name="name" class="form-control" id="name" type="text">
              </div>
              <div class="form-group">
                <label for="sname" class="center-align">Surname:</label>
                <input name="sname" class="form-control" id="sname" type="text">
              </div>
              <div class="form-group">
                <label for="phone">Phone:</label>
                <input name="phone" class="form-control" id="phone" type="number">
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input name="password" class="form-control" id="password" type="password">
              </div>
              <!--
              <div class="form-group">
                <label for="password2">Confirm Password:</label>
                <input name="password2" class="form-control" id="password2" type="password">
              </div>
              -->
              <div class="form-group">
                <center><button type="submit" class="btn btn-primary">Register</button></center>
              </div>
            </form>
          </div>
        </div>
      </div>
  </body>





  <!-- <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <form class="formValidate" id="formValidate" method="post" action="register_process.php" novalidate="novalidate" class="col s12">
        <div class="row">
          <div class="input-field col s12 center">
            <h4>Register</h4>
            <p class="center">Join us now!</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input name="username" id="username" type="text"  data-error=".errorTxt1">
            <label for="username" class="center-align">Username</label>
			<div class="errorTxt1"></div>			
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person prefix"></i>
            <input name="name" id="name" type="text" data-error=".errorTxt2">
            <label for="name" class="center-align">Name</label>
			<div class="errorTxt2"></div>			
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input name="password" id="password" type="password" data-error=".errorTxt3">
            <label for="password">Password</label>
			<div class="errorTxt3"></div>			
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-phone prefix"></i>
            <input name="phone" id="phone" type="number" data-error=".errorTxt4">
            <label for="phone">Phone</label>
			<div class="errorTxt4"></div>			
          </div>
        </div>		
        <div class="row">
          <div class="input-field col s12">
			<a href="javascript:void(0);" onclick="document.getElementById('formValidate').submit();" class="btn waves-effect waves-light col s12">Login</a>
          </div>
          <div class="input-field col s12">
            <p class="margin center medium-small sign-up">Already have an account? <a href="login.php">Login</a></p>
          </div>
        </div>
      </form>
    </div>
  </div> -->


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
  <!--materialize js-->
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>

  <!--plugins.js - Some Specific JS codes for Plugin Settings-->
  <script type="text/javascript" src="js/plugins.min.js"></script>
  <!--custom-script.js - Add your own theme custom JS-->
  <script type="text/javascript" src="js/custom-script.js"></script>
  <script type="text/javascript">
    $("#formValidate").validate({
      rules: {
        username: {
          required: true,
          minlength: 5
        },
        name: {
          required: true,
          minlength: 5
        },
        password: {
          required: true,
          minlength: 5
        },
        phone: {
          required: true,
          minlength: 4
        },
      },
      messages: {
        username: {
          required: "Enter username",
          minlength: "Minimum 5 characters are required."
        },
        name: {
          required: "Enter name",
          minlength: "Minimum 5 characters are required."
        },
        password: {
          required: "Enter password",
          minlength: "Minimum 5 characters are required."
        },
        phone: {
          required: "Specify contact number.",
          minlength: "Minimum 4 characters are required."
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
  </body>

  </html>

<?php
}
?>