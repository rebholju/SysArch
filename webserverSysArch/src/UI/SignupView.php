<?php
class SignupView extends View
{
    
    protected function generateContent()
    {
      echo'
        </div>
        <h1>Sign up</h1>
        <div id="login">
        <form action="?command=Signup" method="post">
        <input type="text" name="firstname" placeholder="Firstname"><br />
        <input type="text" name="lastname" placeholder="Lastname"><br />
        <input type="email" name="email" placeholder="E-Mail"><br />
        <input type="text" name="RFID" placeholder="RFID-NR"><br />
        <input type="text" name="username" placeholder="Username"><br />
        <input type="password" name="pwd" placeholder="password"><br />
        <button type="submit" name="submit" class="buttondesign">Sign in</button>
        
        </form>
        <form action="?command=logout" method="post">
        <button type="submit" name="submit" class="buttondesign">Home</button>
        </form>
        </div>
        
        
        </body>
        </html>';
        
        
    }
}
?>