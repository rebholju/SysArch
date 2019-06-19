<?php

class EditUserView extends View
{
    
    protected function generateContent()
    {
      
        echo '
    </div>
    <br>
    <h1>EditUser</h1>



<div id="login">
        <form action="?command=Signup" method="post">
        <input type="text" name="firstname" placeholder="Firstname"><br />
        <input type="text" name="lastname" placeholder="Lastname"><br />
        <input type="email" name="email" placeholder="E-Mail"><br />
        <input type="text" name="rfidID" placeholder="RFID Nr."><br />
        <input type="text" name="username" placeholder="Username"><br />
        <input type="password" name="pwd" placeholder="password"><br />
        <button type="submit" name="submit" class="buttondesign">Sign in</button>
        </div> 


       
        </body>';
        echo "<br>";
        
        
        
    }
}
?>
