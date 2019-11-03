<?php  
session_start(); 
if(isset($_SESSION['admin_sid']) || isset($_SESSION['customer_sid']))
{
	header("location:./../cafeterias/cafeterias.php");
}
else{
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
    <title>Login</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<a class="navbar-brand" href="./../home/index.php">
			<img src="./../images/logo/logo.png" class="img-fluid" width="30px"><strong>StrathCafe</strong>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
			aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="./../home/index.php">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="./../cafeterias/cafeterias.php">Cafeterias</a>
				</li>
			</ul>

			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="./../registration/register.php"><button class="btn btn-outline-light my-2 my-sm-0"
							type="submit" id="log">
							Register
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
					<form action="login_process.php" method="post">
						<h1>Login</h1>
						<div class="form-group">
							<label for="AdmissionNumber">Admission Number</label>
							<input class="form-control" type="Number" name="username" placeholder="eg. 123456"
								id="AdmissionNumber" required>
						</div>
						<br>
						<div class="form-group">
							<label for="password">Password</label>
							<input class="form-control" type="password" name="password"
								placeholder="Enter your password" id="password" required>
						</div>
						<br>
						<div class="form-group text-center">
							<input class="btn btn-primary" type="submit" value="Login" name="submit">
						</div>
						<p class="text-center"><a class="text-info" href="./../authentication/forgot_password.php">Forgot your
								password?</a></p>
					</form>
				</div>
			</div>
		</div>
	</div>

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

      <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>

</body>
</html>
<?php
}
?>