<?php 
//Login Handler
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
            return 'E-Mail/Benutzernamer oder Passwort ungueltig<br>
                    <a href="resetPwd.php?resetcalled=1>">Passwort zuruecksetzen</a> <br>';
        }
}
}

//Reset Handler
function resetpwdrequest()
{
    session_start();    //compare with cookie
    $pdo = new PDO('mysql:host=localhost; dbname=sysarch','root','');
    
    if(isset($_GET['reset']))
    {
        $email = $_POST['email'];
        
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();
        
        if($user === false)
        {
            return'E-Mail does not exist !!!';
        }
        else
        {
            
            $resetpwd = substr(md5(rand()),0,10);
            $statement = $pdo->prepare("UPDATE users SET resetpassword = ? WHERE email = ?");
            $result = $statement->execute(array($resetpwd, $email));
            
            
            mail($email, 'Reset Password Project System Architecture', 'Gehe zu diesem link<?php>$resetpwd<php>', "From: Absender <ju721reb@htwg-konstanz.de>");
            return'ResetPassword sent!!';
            
        }
    }
    
}

// function reset($email)
// {       

//     $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
//     $result = $statement->execute(array('email' => $email));
//     $user = $statement->fetch();

//     if($user === false)
//     { 
//     return'E-Mail does not exist !!!';
//     }
//     else
//     {
    
//     $resetpwd = substr(md5(rand()),0,10);
//     $statement = $pdo->prepare("UPDATE users SET resetpassword = ? WHERE email = ?");
//     $result = $statement->execute(array($resetpwd, $email));
    
    
//     mail($email, 'Reset Password Project System Architecture', 'Gehe zu diesem link<?php>$resetpwd<php>', "From: Absender <ju721reb@htwg-konstanz.de>");
//     return'ResetPassword sent!!';
        
//     }
    
// }
?>




