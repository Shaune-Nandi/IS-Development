<?php
include '../includes/connect.php';
$user_id = $_SESSION['user_id'];


$name = htmlspecialchars($_POST['name']);
$sname = htmlspecialchars($_POST['sname']);
$username = htmlspecialchars($_POST['username']);
$password =  htmlspecialchars($_POST['password']);
$phone = $_POST['phone'];
$email = htmlspecialchars($_POST['email']);
$address = htmlspecialchars($_POST['address']);
$sql = "UPDATE users SET name = '$name', surname = '$sname', username = '$username', password='$password', contact=$phone, email='$email' WHERE id = $user_id;";
if($con->query($sql)==true){
	$_SESSION['name'] = $name;
}
header("location: ./../details/details.php");
?>