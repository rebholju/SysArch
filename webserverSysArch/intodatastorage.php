<?php
if(isset($_POST['submit'])){
    
    echo 'signed in with: <br />';
    
    echo $_POST["firstname"];
    echo '<br />';
    echo $_POST["secondname"];
    echo '<br />';
    echo $_POST["email"];
    echo '<br />';
    echo $_POST["pwd"];
    
    
    
}

      
   
    

else {
    echo'error';
    exit();
}

?>