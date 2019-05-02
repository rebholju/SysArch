<?php 

function login()
{
if(isset($_POST['submit']))
    {
         
        if( $_POST["uid"]== "test" and $_POST["pwd"] == "1234"){
            echo'<div id = loginr>successfully login</div>';
        }
        else{
            echo'<div id = loginf>wrong password</div>';
        }
}
}

?>