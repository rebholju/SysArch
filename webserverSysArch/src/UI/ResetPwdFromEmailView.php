<?php
class ResetPwdFromEmailView extends View
{
    
    protected function generateContent()
    {
        
        echo '  
    </div>
    <div id="login">
    <form action="?command=resetpwdfromemail" method="post">
    <input type="email" name="email" placeholder="E-Mail"><br />
	<input type="password" name="resetpwd" placeholder="Reset password"><br />
	<input type="password" name="newpwd" placeholder="New password"><br />
	<button type="submit" class="buttondesign">Reset</button>
    </form>
    </div>';
 
       
}
}
?>