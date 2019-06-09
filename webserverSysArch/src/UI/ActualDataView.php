<?php

class ActualDataView extends View
{
    protected function generateContent()
    {
        $refVehicleDataController = new VehicleDataController();
        $data = $refVehicleDataController->getCurrentData();
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


<br></br>




<table id="ActualDataTable">
  <tr>
    <th onclick="sortNumber(0)">Car</th>
    <th onclick="sortName(1)">Sensorname</th>
    <th onclick="sortNumber(2)">Value</th>
    <th onclick="sortNumber(2)">timestemo</th>
  
  </tr>';
for($i=0;$i<sizeof($data);$i++)
{
    echo '<tr><td>';
echo $data[$i]['vehicleNumber'];

echo'</td>
    <td>';

echo $data[$i]['sensor'];

echo'</td>
    <td>';

echo $data[$i]['value'];
echo '</td>
    <td>';
    echo $data[$i]['timeStamp'];
    
    echo'</td>
  </tr>';
}
echo'
</table>';
    
    echo sizeof($data);


echo'







<script>
function sortName(n) {
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