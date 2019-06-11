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
</div>   
        </div>
        
        
        </body>

   </div>';
        echo "<br>";
        
        
        
    }
}
?>
