<?php
class UserDataModel
{
    private $pdo;
    
    /** Constructor of the class UserDataModel. Here is the
     * DB driver loaded and the connection established.
     */
    public function __construct()
    {
        $dsn = 'mysql:host=ea-pc165.ei.htwg-konstanz.de; port=3306; dbname=sysarch_w4';
        // host=ea-pc165.ei.htwg-konstanz.de;
        $dbuser = 'sysarch_w4';
        $dbpwd = 'DEF';
//         //
//         // Hier Datenbank adresse eintragen auf ea-pc165
//           $this->pdo = new PDO('mysql:host=localhost; dbname=SysArch','root','');
             $this->pdo = new PDO($dsn, $dbuser, $dbpwd);
    }
    
    /** Method that compares the the User data with the DB
     * and sets the session with the username
     * @param  $username_email 
     * @param  $password
     * @return boolean status if the login was sucessfull
     */
    public function loginUser($username_email,$password)
    {	 
        
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $result = $statement->execute(array('username' => $username_email));
        $user = $statement->fetch();
        
        if($user == false)
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
    
    /** Unsets the session and save the logout time
     */
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
    
    /** Method that writes the inputvalues into the DB 
     * @param $firstname
     * @param $lastname
     * @param $email
     * @param $username
     * @param $pwd
     * @param $rfidID
     * @return boolean status if the login was sucessfull
     */
    public function signupUser($firstname,$lastname,$email,$username,$pwd,$rfidID)
    {
        $answer ='';
        $error = false;
        $role = 20;
            
            if(empty($firstname)||empty($lastname)||empty($email)||empty($username)||empty($pwd)||empty($rfidID))
            {
                $answer .= '<div id="loginfalse">formular is not filled out completly<br>';
                $error = true;
            }
            else
            {
                
                
                if(!filter_var($email,FILTER_VALIDATE_EMAIL))
                {
                    $answer .= '<div id="loginfalse">not a valid email<br>';
                }
                
                if(!$error)
                {
                    $statement = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
                    $result = $statement->execute(array('username' => $username));
                    $user = $statement->fetch();
                    
                    if($user !== false)
                    {
                        $answer .= '<div id="loginfalse">username exists already<br>';
                        $error = true;
                    }
                    
                    if(!$error)
                    {
                        
                        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                        
                        $statement = $this->pdo->prepare("INSERT INTO users(username, role, firstname, lastname, email, password, rfidID)
                            VALUES(?, ?, ?, ?, ?, ?, ?)");
                        $result = $statement->execute(array( $username, $role, $firstname, $lastname, $email, $hashedPwd, $rfidID));
                        
                        if($result)
                        {
                            $answer .= '<div id="signupsucess">user signed up successfully</a>';
                        }
                        else
                        {
                            $answer .= '<div id="loginfalse">Failure when storing data into database<br>';
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
        return !$error;
    }
        
    /** Method that resets the password with the input of 
     * the user
     * @param $email
     * @param $resetpwd
     * @param $newpwd
     */
    
    public function resetpwd($email, $resetpwd, $newpwd)
        {    if(isset($_GET['command']))
        {
            $answer ="";
            
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
                            $answer .= '<div id="signupsucess">password resetted <br>
                            
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
        
        /** Method that generates and sends an email with 
         * the resetpassword to the users email
         * @param $email
         */
    public function resetpwdrequest($email)
        {
            
                $answer="";
                
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

    /**Method that compares the driver in the JSON file
     * with the userDB and returns the username.
     * But not used this is done in the Java programm
     * @param $JSON
     * @return mixed|boolean
     */
    public function authetficateDriver($JSON)
    {
        
        $data = json_decode($JSON, true);
        
        $rfidID = $data['id'];
        
        $statement = $this->pdo->prepare("SELECT username FROM users WHERE rfidID = :rfidID");
        $result = $statement->execute(array('rfidID' => $rfidID));
        $user = $statement->fetch();
        
        if ($user) {
            return $user['username'];
            
            //JSON File generieren
            //return $returnJSON        
            
        } else {
            return false;         
        }
    }

    /**Mehtod that returns the user role 
     * @param $username
     * @return mixed
     */       
    public function getUserRole($username)
        {
            $statement = $this->pdo->prepare("SELECT role FROM users WHERE username = :username");
            $result = $statement->execute(array('username' => $username));
            $user = $statement->fetch();
            
            if($user)
            {
                return $user['role'];
            }
            else
            {
                $Message = MessageHandler::getInstance();
                $Message->AddMessage('<div id="loginfalse">Failure when calling role from database<br>');
            }
        }
           
    /**Method that returns all user data
     * 
     * @return mixed[]
     */
    public function getUserData()
        {
            $counter = 0;
            $userdata = array();
            
            $statement = $this->pdo->prepare("SELECT * FROM users");
            $result = $statement->execute();
            while ($row = $statement->fetch()) 
            {
                $userdata[] = $row;
                $counter++;
                
            }
            

                
            
            if(!$result)
            {
                $Message = MessageHandler::getInstance();
                $Message->AddMessage('<div id="loginfalse">Failure when calling userdata from database<br>');
            }
            
            return $userdata;
        }

    /**Method that returns only the userdata from the specific user
    * 
    * @param $username
    * @return mixed[]
    */
    public function getOwnUserData($username)
    {
        $counter = 0;
        $userdata = array();
        
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $result = $statement->execute(array('username' => $username));
        while ($row = $statement->fetch())
        {
            $userdata[] = $row;
            $counter++;
            
        }

        if(!$result)
        {
            $Message = MessageHandler::getInstance();
            $Message->AddMessage('<div id="loginfalse">Failure when calling userdata from database<br>');
        }
        
        return $userdata;
    }
    
    /**Method that deletes the user from the DB
     * 
     * @param $userId
     */
    public function deleteUserfromDatabase($userId)
    {
        $statement = $this->pdo->prepare("DELETE FROM users WHERE idUsers = ?");
        $result = $statement->execute(array($userId));
        
        if(!$result)
        {
            $Message = MessageHandler::getInstance();
            $Message->AddMessage('<div id="loginfalse">Failure when deleting Useradta from databaser<br>');
        }
        else
        {
            $Message = MessageHandler::getInstance();
            $Message->AddMessage('<div id="signupsucess">deleted successfully<br>');
        }
        
    }
    
    /** Method that changes user data to the given parameters
     * 
     * @param $firstname
     * @param $lastname
     * @param $email
     * @param $username
     * @param $oldpwd
     * @param $newpwd
     * @param $rfidID
     * @param $userId
     */
    public function editUserinDatabase($firstname, $lastname, $email, $username, $oldpwd, $newpwd, $rfidID, $userId)
    {
        $answer ='';
        $error = false;
        
        if(!empty($oldpwd) && !empty($newpwd))
        {
            $statement = $this->pdo->prepare("SELECT * FROM users WHERE idUsers=?");
            $result = $statement->execute(array($userId));
            $user = $statement->fetch();
            

            //Überprüfung des Passworts
            if ($user !== false && password_verify($oldpwd, $user['password'])) 
            {
                $hashedPwd = password_hash($newpwd, PASSWORD_DEFAULT);
                
                $statement = $this->pdo->prepare("UPDATE users SET  password=? WHERE idUsers = ? ");
                $result = $statement->execute(array($hashedPwd, $userId));
                
                if($result)
                {
                    $answer .= '<div id="signupsucess">Changed password succesfully</a>';
                }
                else
                {
                    $answer .= '<div id="loginfalse">Failure when saving data<br>';
                }
            }
            else
            {
                $answer .= '<div id="loginfalse">Wrong old password !<br>';
            }
        }
        
        
        if(empty($firstname)||empty($lastname)||empty($email)||empty($username)||empty($rfidID))
        {
            $answer .= '<div id="loginfalse">not filled out completly<br>';
            $error = true;
        }
        else
        {
            if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            {
                $answer .= '<div id="loginfalse">not an valid email-adress<br>';
                $error = true;
            }
            
            if(!$error)
            {
                $statement = $this->pdo->prepare("UPDATE users SET  username=?, firstname=?, lastname=?, email=?, rfidID=? WHERE idUsers=? ");
                $result = $statement->execute(array($username, $firstname, $lastname, $email, $rfidID, $userId));
                if(!$result)
                {
                    $answer.='<div id="loginfalse">Failure when updating data<br>';
                    $error = true;
                }
                else
                {
                    $answer .= '<div id="signupsucess">Changed Userdata successfully</a>';
                }
            }

        
        if(!empty($answer))
        {
            $answer .= '</div>';
            $Message = MessageHandler::getInstance();
            $Message->AddMessage($answer);
        }
    }

}
}

    
