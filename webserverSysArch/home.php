<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link href="stylesheet.css" rel="stylesheet">
<?php require_once('userhandler.php')?>
</head>
<body>
<h1>Home</h1>
<div id="login">
	<?php
	session_start();
	if(isset($_SESSION['userid'])) 
	{
	    //Abfrage der Nutzer ID vom Login
	    $userid = $_SESSION['userid'];
	    
	    
	    echo "Hallo User: ".$userid;
	    
        logout() 
	?>
        <form action="?logout=1" method="post">
        	<button type="submit" >Logout</button>
        </form>
        <?php 
    }
    else
    {
    die('Bitte zuerst <a href="index.php">einloggen</a>');
    }
?>


</div>
</body>

</html>

