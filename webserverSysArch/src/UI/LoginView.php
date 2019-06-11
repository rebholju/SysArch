<?php 
// Login-Fenster 2
class LoginView extends View
{  

    protected function generateContent()
    {      

        echo '  
    </div>
    <br>
    <h1>Login</h1>
    <div id="login">
    <form action="?command=login" method="post">
	<input type="text" name="uid" placeholder="username/e-mail"><br />
	<input type="password" name="pwd" placeholder="password"><br />
	<button type="submit" class="buttondesign">Login</button>
    </form>
    </div>';
       	echo "<br>";
       	
       	

    }   
}

?>