<?php
class ResetPwdView extends View
{
    
    protected function generateContent()
    {
        
        echo '
            <div id="login">
            <form action="?command=resetpwd" method="post">
	        <input type="email" name="email" placeholder="E-Mail"><br />
	        <button type="submit" class="buttondesign" >Reset</button>
            </div>
            </form>';
        
        
        
    }
}

?>