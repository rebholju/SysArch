<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="stylesheet.css" rel="stylesheet">
	<?php require_once('login.php')?>
</head>
<body>
<h1>Login</h1>
<div id="login">
	<?php login() ?>
<form action="?login=1" method="post">
	<input type="text" name="uid" placeholder="username/e-mail"><br />
	<input type="password" name="pwd" placeholder="password"><br />
	<button type="submit" name="submit" >Login</button>
</form>
	<a href="signup.php">Sign up</a>

</div>
</body>

</html>

