
<?php
session_start();    //compare with cookie
$pdo = new PDO('mysql:host=localhost; dbname=sysarch','root','');
?>

<!DOCTYPE html>
<html>
<head>
<title>Sign up</title>
<link href="stylesheet.css" rel="stylesheet">
</head>
<body>

<?php

$showFormular = true;       // ob Fomrular angezeigt werden soll
$answer ='';

if(isset($_GET['registerindB']))
{
    $error = false;
    $firstname = $_POST['firstname']; 
    $email = $_POST['email'];
    $lastname = $_POST['lastname'];
    
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    
    if(empty($firstname)||empty($lastname)||empty($email)||empty($username)||empty($pwd))
    {
        $answer .= "Formular nicht komplett ausgefuellt<br>";
        $error = true;
    }
    else 
    {
        
        
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $answer .= 'keine gueltige E-Mail-Adresse angegeben<br>';
        }
        
        if(!$error)
        {
            $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $result = $statement->execute(array('username' => $username));
            $user = $statement->fetch();
            
            if($user !== false)
            {
                $answer .= 'Username bereits vergeben !<br>';
                $error = true;
            }
            
               if(!$error)
                {
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    
                    $statement = $pdo->prepare("INSERT INTO users(username, firstname, lastname, email, password)
                            VALUES(?, ?, ?, ?, ?)");
                    $result = $statement->execute(array( $username, $firstname, $lastname, $email, $hashedPwd));
                    
                    if($result)
                    {
                        $answer .= 'Sie wurden erfolgreich registriert !<br><a href="index.php">Zum Login</a>';
                    }
                    else
                    {
                        $answer .= 'Es ist ein Fehler beim Abspeichern passiert !<br><a href="signup.php">Zur Registrierung</a>';
                    }
               }   
        }
    }
}

if($showFormular) {         // ob untere Teil angezeigt werden soll
 ?>
 

<h1>Sign up</h1>
<div id="signup">
<form action="?registerindB=1" method="post">
	<input type="text" name="firstname" placeholder="Firstname"><br />
	<input type="text" name="lastname" placeholder="Lastname"><br />
	<input type="email" name="email" placeholder="E-Mail"><br />
	<input type="text" name="username" placeholder="Username"><br />
	<input type="password" name="pwd" placeholder="password"><br />
	<button type="submit" name="submit" >Sign in</button>
	
</form>
<?php 
}                      // Klammer der if schleife wieder schließen
if(!empty($answer))
{
    echo $answer;
}
?>

	<a href="index.php">Home</a>
</div>


</body>
</html>
