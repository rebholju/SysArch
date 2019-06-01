<?php

class HomeView extends View
{

    protected function generateContent()
    {
         $username = $_SESSION['username'];  
         echo '<a id="loggedinas">' ?><?php echo $username;?><?php ;
        
echo'
    </a>
  <form action="?command=logout" method="post">
  <button type="submit" >logout</button>
<div id="nav">
  <a id="orange" href="home.php">Home</a>
  <a id="green" href="index.php">Historical Data</a>
    </div>';
        echo "<br>";
        
        
        
    }
}
?>
