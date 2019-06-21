
<?php

class HistoricalDataView extends View
{
    protected function generateContent()
    {
        $refVehicleDataController = new VehicleDataController();
        $data = $refVehicleDataController->getHistoricalData();
        $user = new UserController();
        $pressedButton ='Showa';
        
        echo '
    </div>
    <br></br>
<br></br>

<b>Select a Sensor!</b

<br></br>
    <div id="historicalbutton">
            <form  action="" method="post">
            <input type="submit" name="lidar" value="LIDAR"/>
            </form>
     </div>

    <div id="historicalbutton">
            <form action="" method="post">
           <input type="submit" name="cpuTemp" value="CPU"/>
            </form>
     </div>

      <div id="historicalbutton">
        <form action="" method="post">
           <input type="submit" name="Speed" value="Speed"/>
        </form>
      </div>

        <div id="historicalbutton">
        <form action="" method="post">
           <input type="submit" name="jitter" value="Jitter"/>
        </form>
       </div>

        <div id="historicalbutton">
        <form action="" method="post">
           <input type="submit" name="numOfRTThreads" value="Threads"/>
        </form>
        </div>

        <div id="historicalbutton">
        <form action="" method="post">
           <input type="submit" name="BatteryPower" value="Battery"/>
        </form>
        </div>

        <div id="historicalbutton">
        <form action="" method="post">
           <input type="submit" name="Showall" value="ALL_DATA"/>
        </form>
        </div>

    
<table id="HistoricalDataTable">
  <tr>
    <th onclick="sortNumber(0)">Car</th>
    <th onclick="sortName(1)">Sensorname</th>
    <th onclick="sortNumber(2)">Value</th>
    <th onclick="sortName(3)">timestemp</th>';
    if($user->getRole()==10)
    {
    echo'<th onclick="sortNumber(4)">Driver</th>';
    }
    echo'


  </tr>';
    echo '

<br></br>






</div>';
    
    
   
    
    

    if(isset($_POST["lidar"])) {
        $pressedButton='LIDAR';
    }
    else if (isset($_POST["cpuTemp"])){
        $pressedButton='CPUTemp';
    }
    else if (isset($_POST["Speed"])){
        $pressedButton='Speed';
    }
    else if (isset($_POST["jitter"])){
        $pressedButton='jitter';
    }
    else if (isset($_POST["numOfRTThreads"])){
        $pressedButton='numOfRTThreads';
    }
    else if (isset($_POST["BatteryPower"])){
        $pressedButton='BatteryPower';
    }
    else if (isset($_POST["Showall"])){
        $pressedButton='Showa';
               
    }
   if( ! isset($_GET['test']))
   {
        for($i=0;$i<sizeof($data);$i++)
        {
            if($data[$i]['sensor']== $pressedButton || $pressedButton=='Showa')
            {
                echo '<tr><td>';
                
                echo $data[$i]['vehicleNumber'];
                
                echo'</td><td>';
                
                echo $data[$i]['sensor'];
                
                echo'</td><td>';
                
                echo $data[$i]['value'];
                
                echo '</td><td>';
                
                echo $data[$i]['timeStamp'];
                
                echo '</td>';
                if($user->getRole()==10)
                {   echo'<td>';
                echo $data[$i]['driver'];
                echo'</td></tr>';
                }
                else
                {
                    echo '</tr>';
                }
            }
            
            }
        }
          
    
 
    
            
        echo'
</table>';
          
        
        echo'
            
         
            
        
            
            
            
<script>
function sortName(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("HistoricalDataTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc";
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
            
function sortNumber(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("HistoricalDataTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc";
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (Number(x.innerHTML) > Number(y.innerHTML)) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (Number(x.innerHTML) < Number(y.innerHTML)) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
            
            
</script>
            
</body>
   </div>';
        
        echo "<br>";
    }
    
    
    
}
?>