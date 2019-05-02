<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="stylesheet.css" rel="stylesheet">
</head>
<body>
<h1>Login</h1>
<div id="login">
<?php 
if(isset($_POST['submit']))
    {
         
        if( $_POST["uid"]== "test" and $_POST["pwd"] == "1234"){
            echo'<div id=loginr> successfully login </div>';
        }
        else{
            echo'<div id=loginf>wrong password</div>';
        }
            
    }
    

?>
<form action="?login=1" method="post">
	<input type="text" name="uid" placeholder="username/e-mail"><br />
	<input type="password" name="pwd" placeholder="password"><br />
	<button type="submit" name="submit" >Login</button>
</form>
	<a href="signup.php">Sign up</a>

</div>
</body>




</html>

