<?php

class EditUserView extends View
{
    
    protected function generateContent()
    {
      
        echo '
    </div>
    <br>
    <h1>Change User Data</h1>
    <div id="editUser">
   Username:<br></br>
     Lastname:<br></br>
         E-Mail:<br></br>
            Password:<br></br>
    </div>
 <div id="editUser">
    <form action="?command=login" method="post">
	<input type="text" name="uid" placeholder="new username"><br><br />
    </form>
    <form action="?command=login" method="post">
	<input type="text" name="uid" placeholder="new Lastname"><br><br />
    </form>
<form action="?command=login" method="post">
	<input type="text" name="uid" placeholder="E-Mail"><br><br />
    </form>
<form action="?command=login" method="post">
	<input type="text" name="uid" placeholder="Password"><br><br />
    </form>
    </div>';
        echo "<br>";
        
        
    }
}
?>
