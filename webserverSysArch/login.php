<?php 
if(isset($_POST['submit']))
    {
         
        if( $_POST["uid"]== "test" and $_POST["pwd"] == "1234"){
            echo'successfully login';
        }
        else{
            echo'wrong password';
        }
            
    }
    else {
        echo'error';
        exit();
    }

?>