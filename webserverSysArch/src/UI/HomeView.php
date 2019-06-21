<?php

class HomeView extends View
{
    
    protected function generateContent()
    {
        $username = $_SESSION['username'];
        $refUserController = new UserController();
        $userdata = $refUserController->getAllUserData();
        
echo'
    <br>
    <h1>Welcome '.$username.'</h1> 

  <div class="center">
Always a good ride :) 
<br></br>
You are logged in as ';if($refUserController->getRole() == 10)
{
    echo'an Admin';
}
else
{
    echo'an User';
}
echo'  
               </div>';
        echo "<br>";
        
        echo'
                <table id="ActualDataTable">
                <tr>
                <th onclick="sortName(0)">Username</th>
                <th onclick="sortName(1)">Firstname</th>
                <th onclick="sortName(2)">Lastname</th>
                <th onclick="sortName(3)">E-Mail</th>
                <th onclick="sortName(4)">RFID ID</th>
                <th onclick="sortName(3)">Old Passwort</th>
                <th onclick="sortName(4)">New Password</th></tr>';
        
        
        echo'
                <div id="login">
               <form action="?command=EditUser&number=';
        echo $userdata[0]['idUsers'];
        echo'" method="post" >
                </div>';
        
        
        for($i=0;$i<sizeof($userdata);$i++)
        {
            echo'</td></tr>';
            
            echo '<tr><td>';
            
            echo'<input type="text" class="userinputchange" name="username" value="';
            echo $userdata[$i]['username'];
            echo'"><br />';
             
            echo'</td><td>';
            echo'<input type="text" class="userinputchange" name="firstname" value="';
            echo $userdata[$i]['firstname'];
            echo'"><br />';     
            echo'</td><td>';
            
            echo'<input type="text" class="userinputchange" name="lastname" value="';
            echo $userdata[$i]['lastname'];
            echo'"><br />'; 
            echo '</td><td>';
            
            echo'<input type="email" class="userinputchange" name="email" value="';
            echo $userdata[$i]['email'];
            echo'"><br />';   
            echo'</td><td>';
            
            echo'<input type="text" class="userinputchange" name="rfidID" value="';
            echo $userdata[$i]['rfidID'];
            echo'"><br />';   
            echo'</td><td>';
            
            echo'<input type="password" class="userinputchange" name="oldpwd" placeholder="old password"';
            echo'"><br />';
            echo'</td><td>';
            
            echo'<input type="password" class="userinputchange" name="newpwd" placeholder="new password"';
            echo'"><br />';
            echo'</td></tr>';
        }
        echo'
</table>';
     echo'
        <br>
        <div id="login">
        <button type="submit" class="buttondesign">EditProfile</button>
        </form>
        </div> ';
  
    }
}
?>
