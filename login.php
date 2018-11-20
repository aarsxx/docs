<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="action/user/doLogin.php" method="POST">
	<div>
		<input type="text" name="username" placeholder="Username">
	</div>
	<div>
		<input type="password" name="password" placeholder="Password">
	</div>
	<div>
		<input type="submit" value="Login">
	</div>
</form>
<form action="action/user/doRegister.php" method="POST">
	<div>
		<input type="text" name="username" placeholder="Username" value="<?= $_GET['username'] ?? '' ?>">
		<span><?= $_GET['err_username'] ?? '' ?></span>
	</div>
	<div>
		<input type="password" name="password" placeholder="Password">
		<span><?= $_GET['err_password'] ?? '' ?></span>
	</div>
	<div>
		<input type="password" name="password_confirmation" placeholder="Password Confirmation">
		<span><?= $_GET['err_password_confirmation'] ?? '' ?></span>
	</div>
	<div>
		<input type="submit" value="Register">
		<span><?= $_GET['message'] ?? '' ?></span>
	</div>
</form>
</body>
</html>