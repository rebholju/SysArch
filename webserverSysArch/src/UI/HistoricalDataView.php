<?php

class HistoricalDataView extends View
{
    protected function generateContent()
    {
        
        $username = $_SESSION['username'];
        echo '<a id="loggedinas">' ?><?php echo $username;?><?php ;
        
echo'
    </a>
        <form action="?command=logout" method="post">
        <button type="submit" >logout</button>
        </form>
</div>



<div id="nav">
<a id="red" href="index.php?command=HomeView">Home</a>
<a id="orange" href="index.php?command=HistoricalDataView">HistoricalData</a>
<a id="green" href="index.php?command=ActualDataView">ActualData</a>
<a id="blue" href="index.php?command=SignupView">AddUser</a>
  </div>
   </div>';
  echo "<br>";
    
    }
    
}
?>