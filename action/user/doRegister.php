<?php

require '../connect.php';

$username = $_POST['username'];
$password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation'];

$err_username = '';
$err_password = '';
$err_password_confirmation = '';

if($username == "")
	$err_username = 'Username harus diisi';

if($password == "")
	$err_password = 'Password harus diisi';

if($password != $password_confirmation)
	$err_password_confirmation = 'Password tidak sama';

if($err_username != '' || $err_password != '' || $err_password_confirmation != ''){
	$query_string = "?err_username=$err_username";
	$query_string .= "&err_password=$err_password";
	$query_string .= "&err_password_confirmation=$err_password_confirmation";
	$query_string .= "&username=$username";

	header("Location:../../login.php$query_string");
	die();
}

$password = md5($password);
$query = "INSERT INTO users(username,password) VALUES('$username', '$password')";
mysqli_query($con, $query);

$query_string = '?message=Registrasi berhasil';
header("Location:../../login.php$query_string");
die();