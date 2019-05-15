<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
<link href="stylesheet.css" rel="stylesheet">
<?php require_once('userhandler.php')?>
</head>
<body>
<div id="login">
	<?php $Message = resetpwd() ?>
<form action="?reset=1" method="post">
	<input type="email" name="email" placeholder="E-Mail"><br />
	<button type="submit" >Reset</button>
</form>
<?php 
if(!empty($Message))
{
    echo $Message;
    
}
?>
</div>
<?php

?>