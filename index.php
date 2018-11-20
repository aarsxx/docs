<!DOCTYPE html>
<html>
<head>
	<title>Basic PHP</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<nav>
	<div style="float:right">
		<span>Username</span>
		<span>
			<a href="#">Logout</a>
		</span>
	</div>
</nav>

<div class="card">
	<form action="action/post/doInsert.php" method="POST">
		<textarea name="post"></textarea>
		<input type="submit" value="Post">
	</form>
</div>

<div class="card">
	<header>Post Header</header>
	<article>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</article>
</div>
<div class="card">
	<header>Post Header</header>
	<article>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</article>
</div>


</body>
</html>