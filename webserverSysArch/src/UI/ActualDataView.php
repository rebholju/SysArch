<?php

class ActualDataView extends View
{
    protected function generateContent()
    {
        $refVehicleDataController = new VehicleDataController();
        $data = $refVehicleDataController->getCurrentData();
        
        $user = new UserController();
 
echo'</div><br></br><br></br>
     <div id="login">      
     <div class="dropdown">
     <button class="dropbtn">Select a diagram!</button>
     <div class="dropdown-content">
     <a href="index.php?command=Lidar">Lidar</a></div></div></div>';       

echo'
<table id="ActualDataTable">
<br><br>
  <tr>
    <th onclick="sortNumber(0)">Vehicle &#8595&#8593</th>
    <th onclick="sortName(1)">Sensor name &#8595&#8593</th>
    <th onclick="sortNumber(2)">Value &#8595&#8593</th>
    <th onclick="sortName(3)">Unit &#8595&#8593</th>
    <th onclick="sortName(4)">Timestamp &#8595&#8593</th>';
    
    if($user->getRole()==10)
    {
    echo'
    <th onclick="sortName(5)">Driver  &#8595&#8593</th>';
    }
    echo'
  
  </tr>';
for($i=0;$i<sizeof($data);$i++)
{
    echo '<tr><td>';
    
    echo $data[$i]['vehicleNumber'];

    echo'</td><td>';
    
    if(strcmp($data[$i]['sensor'], "LidarDistances") == 0) {
        $lidararray = explode(";",$data[$i]['value']);
        echo $data[$i]['sensor'];

        echo'</td><td>';
    
        echo $lidararray[0];

        echo '</td><td>';
        
        echo ''. $data[$i]['unit'] .' at 0 &deg;';
        
        echo '</td><td>';
    }
    else if( (strcmp($data[$i]['sensor'], "Acceleration") || strcmp($data[$i]['sensor'], "Gyro")) == 0) {
        $valuearray = explode(",",$data[$i]['value']);
        echo $data[$i]['sensor'];
        
        echo'</td><td>';
        
        echo $valuearray[0] .'<br>'. $valuearray[1] .'<br>'. $valuearray[2];
        
        echo '</td><td>';
        
        echo '[x]<br>[y] '. $data[$i]['unit'] .'<br>[z]';
        
        echo '</td><td>';
    }
    else {
        echo $data[$i]['sensor'];
        
        echo'</td><td>';
        
        echo $data[$i]['value'];
        
        echo '</td><td>';
        
        echo $data[$i]['unit'];
        
        echo '</td><td>';
    }
    

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

echo'
</table>';


echo'







<script>
function sortName(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("ActualDataTable");
    switching = true;
 
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
      table = document.getElementById("ActualDataTable");
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