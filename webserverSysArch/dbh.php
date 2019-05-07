<?php

    
    $servername = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "sysarch";
    
    $conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
    
    if(!$conn)
    {
        die("failure".mysqli_connect_error());
    }
    
    

?>