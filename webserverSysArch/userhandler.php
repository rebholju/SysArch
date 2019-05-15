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
                    <a href="resetPwd.php">Passwort zuruecksetzen</a> <br>';
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
            mail($email, 'Reset Password Project System Architecture',
                "Your Reset password:" .$resetpwd."
                 go to this link: http://localhost/SysArch/webserverSysArch/resetPwd.php?resetpwdfromemail=1", "From: SysArch Projekt");
            return'ResetPassword sent!!';
            
        }
    }
    
}

 function resetpwd()
 {    if(isset($_GET['reset']))
 {
     $pdo = new PDO('mysql:host=localhost; dbname=sysarch','root','');
 
     $email = $_POST['email'];
     $resetpwd = $_POST['resetpwd'];
     $newpwd = $_POST['newpwd'];
     
     $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
     $result = $statement->execute(array('email' => $email));
     $user = $statement->fetch();

    if($user === false)
    { 
    return'E-Mail does not exist !!!';
    }
    else
    {
        //Überprüfung des Passworts
        if ($user['resetpassword'] === $resetpwd) 
        {

            if(empty($newpwd))
            {
                return'enter a new password';
            }
            else 
            {
                //resetpassword hashen
                $resetpwd = substr(md5(rand()),0,10);
                $statement = $pdo->prepare("UPDATE users SET resetpassword = ? WHERE email = ?");
                $result = $statement->execute(array($resetpwd, $email));
                $hashedresetpwd = password_hash($resetpwd, PASSWORD_DEFAULT);
                
                //neues Password hashen
                $hashedPwd = password_hash($newpwd, PASSWORD_DEFAULT);
                $statement = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
                $result = $statement->execute(array($hashedPwd, $email));
                if($result)
                {
                   return'password resetted <br>
                           <a href="index.php">Login</a> <br>';
                }
                else {
                    return 'failure change password';
                }
            }
            
        }
        else {
            return 'Reset password wrong';
        }


        
    }
    
 }
 }
?>




