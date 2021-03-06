<?php

class OptionsView extends View
{
    protected function generateContent()
    {
        $refUserController = new UserController();
        $userdata = $refUserController->getAllUserData();
        
        echo'     
               <br>
               <br>
               <br> 
               <div id="login">
               <form action="?command=NewVehicle" method="post" >
               <input type="text" name="vehicleNumber" placeholder="Vehiclenumber"><br />
               <button type="submit" class="buttondesign">Register new Vehicle</button>
               </form>
               <br>
               <br>
               <br>  


    
               <form action="?command=SignupView" method="post">
               <button type="submit" class="buttondesign">Signup new User</button>
               </form>
               </div>';
        
        echo'
                <table id="ActualDataTable">
                <tr>
                <th onclick="sortName(0)">Username &#8595&#8593</th>
                <th onclick="sortName(1)">Firstname &#8595&#8593</th>
                <th onclick="sortName(2)">Lastname &#8595&#8593</th>
                <th onclick="sortName(3)">E-Mail &#8595&#8593</th>
                <th onclick="sortNumber(4)">RFID ID &#8595&#8593</th>
                <th onclick="sortName(5)">Last Login &#8595&#8593</th>
                <th>Delete User</th>
                            
                </tr>';
        
        for($i=0;$i<sizeof($userdata);$i++)
        {
            echo '<tr><td>';
            echo $userdata[$i]['username'];
            echo'</td><td>';
            
            echo $userdata[$i]['firstname'];
            echo'</td><td>';
            
            echo $userdata[$i]['lastname'];
            echo '</td><td>';
            
            echo $userdata[$i]['email'];
            echo'</td><td>';
            
            echo $userdata[$i]['rfidID'];
            echo'</td> <td>';
            
            echo $userdata[$i]['lastlogin'];
            echo'</td> <td>';
            
            echo'              
                <div id="login">
               <form action="?command=DeleteUser&number=';
            echo $userdata[$i]['idUsers'];
                echo'" method="post" >
               <button type="submit" class="buttondesign">Delete User</button>
               </form>
                </div>';
            echo'</td></tr>';
        }
        echo'
</table>';
 
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