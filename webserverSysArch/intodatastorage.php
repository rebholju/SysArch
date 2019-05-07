
<?php
if(isset($_POST['submit']))
{
    
    require 'dbh.php';
    
    $firstname = $_POST['firstname']; 
    $email = $_POST['email'];
    $lastname = $_POST['lastname'];
    
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    
    if(!mysqli_select_db($conn,'sysarch'))
    {
        echo "Database not selected";
    }
    
    if(empty($firstname)||empty($lastname)||empty($email)||empty($username)||empty($pwd))
    {
        echo " not filled out completly";
        exit();
    }
    else
    {
        $sql ="SELECT username FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            
            echo "sql error";
            exit();
        }        
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0)
            {
                echo"username exists already";
                exit();
            }
            else 
            {
                $sql = "INSERT INTO users(username, firstname, lastname, email, password)
                        VALUES(?, ?, ?, ?, ?)";
                 $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql))
                {
                    echo "error3";
                    exit();
                }
                else
                {
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    
                
                    mysqli_stmt_bind_param($stmt, "sssss", $username, $firstname, $lastname, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    
                        echo"signed up";
        
                 }
              }
        }
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else 
{
    header("location: ../signup.php");
    exit();
}
 ?>
