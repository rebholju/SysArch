<?php
class UserDataModel
{
    private $pdo;
  public function __construct()
    {
        // Hier Datenbank adresse eintragen auf ea-pc165
        $this->pdo = new PDO('mysql:host=localhost; dbname=SysArch','root','');
    }
    
    public function loginUser($username_email,$password)
    {	 
        
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $result = $statement->execute(array('username' => $username_email));
        $user = $statement->fetch();
        
        if($user === false)
        {
            $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
            $result = $statement->execute(array('email' => $username_email));
            $user = $statement->fetch();
        }
        
        //Überprüfung des Passworts
        if ($user !== false && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];      
            return true;
        } else {
            
            $Message = MessageHandler::getInstance();
            $Message->AddMessage('<div id="loginfalse">E-Mail/Benutzernamer oder Passwort ungueltig<br>
                        </form>
                        <form action="?command=resetpwdView" method="post">
                        <button type="submit" class="buttondesign">Reset Password</button>
                    </div>');
            return false;
        }
        
        
    
        
    }
    
    public function logoutUser()
    {
    if(isset($_GET['command'])=="logout")
    {
        if(isset($_SESSION['username']))
        {
        $statement = $this->pdo->prepare("UPDATE users SET lastlogin = ? WHERE username = ?");
        $result = $statement->execute(array(date('Y-m-d H:i:s'),$_SESSION['username']));
        }
        
        unset($_SESSION['username']);              
    }
    }
    
    public function signupUser($firstname,$lastname,$email,$username,$pwd,$rfidID)
    {
        $answer ='';
        $error = false;
            
            if(empty($firstname)||empty($lastname)||empty($email)||empty($username)||empty($pwd)||empty($rfidID))
            {
                $answer .= '<div id="loginfalse">Formular nicht komplett ausgefuellt<br>';
                $error = true;
            }
            else
            {
                
                
                if(!filter_var($email,FILTER_VALIDATE_EMAIL))
                {
                    $answer .= '<div id="loginfalse">keine gueltige E-Mail-Adresse angegeben<br>';
                }
                
                if(!$error)
                {
                    $statement = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
                    $result = $statement->execute(array('username' => $username));
                    $user = $statement->fetch();
                    
                    if($user !== false)
                    {
                        $answer .= '<div id="loginfalse">Username bereits vergeben !<br>';
                        $error = true;
                    }
                    
                    if(!$error)
                    {
                        
                        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                        
                        $statement = $this->pdo->prepare("INSERT INTO users(username, firstname, lastname, email, password, rfidID)
                            VALUES(?, ?, ?, ?, ?, ?)");
                        $result = $statement->execute(array( $username, $firstname, $lastname, $email, $hashedPwd, $rfidID));
                        
                        if($result)
                        {
                            $answer .= '<div id="signupsucess">Neuen Benutzer erfolgreich registriert !</a>';
                        }
                        else
                        {
                            $answer .= '<div id="loginfalse">Es ist ein Fehler beim Abspeichern passiert !<br>';
                        }
                    }
                }
            }
        
        
        if(!empty($answer))
        {
            $answer .= '</div>';
             $Message = MessageHandler::getInstance();
             $Message->AddMessage($answer);
        }
    }
        
    public function resetpwd($email, $resetpwd, $newpwd)
        {    if(isset($_GET['command']))
        {
            $answer ="";
//             $email = $_POST['email'];
//             $resetpwd = $_POST['resetpwd'];
//             $newpwd = $_POST['newpwd'];
            
            $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
            $result = $statement->execute(array('email' => $email));
            $user = $statement->fetch();
            
            if($user === false)
            {
                $answer .= '<div id="loginfalse">E-Mail does not exist !!!';
            }
            else
            {
                //Überprüfung des Passworts
                if($user !== false && password_verify($resetpwd, $user['resetpassword']))
                {
                    
                    if(empty($newpwd))
                    {
                        $answer .= '<div id="loginfalse">enter a new password';
                    }
                    else
                    {
                        
                        $resetpwd = NULL;
                        $statement = $this->pdo->prepare("UPDATE users SET resetpassword = ? WHERE email = ?");
                        $result = $statement->execute(array($resetpwd, $email));
                        
                        $hashedPwd = password_hash($newpwd, PASSWORD_DEFAULT);
                        $statement = $this->pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
                        $result = $statement->execute(array($hashedPwd, $email));
                        if($result)
                        {
                            $answer .= '<div id="#signupsucess">password resetted <br><div/>
                            <div>
                            <form action="?command=logout" method="post">
                            <button type="submit" class="buttondesign" >Home</button>
                            ';
                        }
                        else {
                            $answer .= '<div id="loginfalse">failure change password';
                        }
                    }
                    
                }
                else {
                    $answer .= '<div id="loginfalse">Reset password wrong';
                }
                
                
                
            }
            
        
        }
        if(!empty($answer))
        {
            $answer .= '</div>';
            $Message = MessageHandler::getInstance();
            $Message->AddMessage($answer);
        }
        }
        
    public function resetpwdrequest($email)
        {
            
                $answer="";
      //          $email = $_POST['email'];
                
                $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
                $result = $statement->execute(array('email' => $email));
                $user = $statement->fetch();
                
                if($user === false)
                {
                    $answer .= '<div id="loginfalse">E-Mail does not exist !!!';
                }
                else
                {
                    
                    $resetpwd = substr(md5(rand()),0,10);
                    $hashedresetpwd = password_hash($resetpwd, PASSWORD_DEFAULT);
                    $statement = $this->pdo->prepare("UPDATE users SET resetpassword = ? WHERE email = ?");
                    $result = $statement->execute(array($hashedresetpwd, $email));
                    mail($email, 'Reset Password Project System Architecture',
"Your Reset password:" .$resetpwd."
go to this link: http://localhost/SysArch/webserverSysArch/index.php?command=resetpwdfromemailView", "From: SysArch Projekt");
                    $answer .= '<div id="signupsucess">ResetPassword sent!!';
                    
                }

            if(!empty($answer))
            {
                $answer .= '</div>';
                $Message = MessageHandler::getInstance();
                $Message->AddMessage($answer);
            }
            
    }

    public function authetficateDriver($rfidID)
    {

       // $username = $_SESSION['username'];
       $username = 'rebholju'; // nur vorübergehend
        
        $statement = $this->pdo->prepare("SELECT rfidID FROM users WHERE username = :username");
        $result = $statement->execute(array('username' => $username));
        $user = $statement->fetch();
        
        //Überprüfung des Passworts
        if ($rfidID == $user['rfidID']) {
            return true;
        } else {
            return false;
//             $Message = MessageHandler::getInstance();
//             $Message->AddMessage('<div id="loginfalse">E-Mail/Benutzernamer oder Passwort ungueltig<br>
//                         </form>
//                         <form action="?command=resetpwdView" method="post">
//                         <button type="submit" class="buttondesign">Reset Password</button>
//                     </div>');           
        }
        
        
    }
   
    
    
}


    
