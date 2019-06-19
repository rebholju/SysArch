<?php

class HomeView extends View
{
    
    protected function generateContent()
    {
        $username = $_SESSION['username'];

        
echo'
    <br>
    <h1>Welcome User: '.$username.'</h1> 

  <div class="center">
Always a good ride :) 
<br></br>
<br></br>
<a href="index.php?command=EditUserView">EditUser</a>
</div>   


        </div>
        
        
        </body>

   </div>';
        echo "<br>";
        
        
        
    }
}
?>
