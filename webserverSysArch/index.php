<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="stylesheet.css" rel="stylesheet">
	<?php require_once('userhandler.php')?>
</head>
<body>
<h1>Login</h1>
<div id="login">
	<?php $errorMessage = login() ?>
<form action="?login=1" method="post">
	<input type="text" name="uid" placeholder="username/e-mail"><br />
	<input type="password" name="pwd" placeholder="password"><br />
	<button type="submit" >Login</button>
</form>
<?php 
if(!empty($errorMessage))
{
    echo $errorMessage;
    
}
?>
	<a href="signup.php">Sign up</a>


</div>
</body>

</html>

