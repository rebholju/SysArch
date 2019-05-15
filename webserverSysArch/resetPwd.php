<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>
<link href="stylesheet.css" rel="stylesheet">
<?php require('userhandler.php')?>
</head>
<body>
<div id="login">
	<?php 
	if(!isset($_GET['resetpwdfromemail']))
	{
	$Message = resetpwdrequest() ?>
<form action="?reset=1" method="post">
	<input type="email" name="email" placeholder="E-Mail"><br />
	<button type="submit" >Reset</button>
</form>
<?php 
if(!empty($Message))
{
    echo $Message;
    
}
	}
?>

<?php
if(isset($_GET['resetpwdfromemail']))
{
    $pwdresetMessage = resetpwd();?>
    
    <form action="?reset=1&resetpwdfromemail=1" method="post">
    <input type="email" name="email" placeholder="E-Mail"><br />
	<input type="password" name="resetpwd" placeholder="Reset password"><br />
	<input type="password" name="newpwd" placeholder="New password"><br />
	<button type="submit" >Reset</button>
</form>

    <?php
    
    echo $pwdresetMessage;
}

?>
</div>
</body>

</html>