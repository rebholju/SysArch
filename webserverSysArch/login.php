<?php 

function login()
{
    session_start();    //compare with cookie
    $pdo = new PDO('mysql:host=localhost; dbname=sysarch','root','');
    
if(isset($_GET['login']))
    {
        $username_email = $_POST['uid'];
        $password = $_POST['pwd'];
        
        $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $result = $statement->execute(array('username' => $username_email));
        $user = $statement->fetch();
        
        if($user === false)
        {
           $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
           $result = $statement->execute(array('email' => $username_email));
           $user = $statement->fetch();
        }
        
        //Überprüfung des Passworts
        if ($user !== false && password_verify($password, $user['password'])) {
            $_SESSION['userid'] = $user['idUsers'];
            die('Login erfolgreich. Weiter zu <a href="home.php">internen Bereich</a>');
        } else {
            return "E-Mail/Benutzernamer oder Passwort war ungueltig<br>";
        }
}
}

?>