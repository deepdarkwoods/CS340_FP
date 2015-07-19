<?php
error_reporting(E_ALL);
include 'header.php';



//taken from class book, page 270 Ch.11
/*******************************************/
$db = new mysqli('localhost','brad','brad','hotel');
if($db->connect_errno)
    {
        echo "Failed to Connect to Server. Server Error -> " . $db->connect_errno;
    }
/*******************************************/





//user has entered a reservation number
if(isset($_POST["searchNum"]) && $_POST["searchNum"] !="")
    {
      
        $searchNum = intval($_POST["searchNum"]);
        $stmt1 =    "SELECT reservation,checkin,checkout,adults,children,fname,lname
                    FROM guest
                    INNER JOIN reservations ON guest.id = reservations.guestid
                    INNER JOIN reservations_rooms ON reservations.reservation = reservations_rooms.resid                    
                    WHERE reservation = $searchNum
                    GROUP BY reservation";
                    
         $result = $db->query($stmt1);
         showResults($result);     
        
    }

//user has entered a last name to search
elseif(isset($_POST["searchName"]) && $_POST["searchName"] !="")
    {
        
        $searchName = ($_POST["searchName"]);        
        $stmt1 =    "SELECT reservation,checkin,checkout,adults,children,fname,lname
                    FROM guest
                    INNER JOIN reservations ON guest.id = reservations.guestid
                    INNER JOIN reservations_rooms ON reservations.reservation = reservations_rooms.resid                    
                    WHERE lname = '{$searchName}'
                    GROUP BY reservation";
                   
         $result = $db->query($stmt1);
         showResults($result);        
        
    }

//show all reservations ascending order by last name
else
//
    {

        $stmt1 =    "SELECT reservation,checkin,checkout,adults,children,fname,lname
                    FROM guest
                    INNER JOIN reservations ON guest.id = reservations.guestid
                    INNER JOIN reservations_rooms ON reservations.reservation = reservations_rooms.resid
                    GROUP BY reservation
                    ORDER BY lname";   
                 
        $result = $db->query($stmt1);
        showResults($result);
    }









//Displays reservation result set
function showResults($result)
{
    $num_results = $result->num_rows;
    if($num_results == 0 )
    
        {
            echo "No Results Found !";
        }
        
    else
        {
    
            echo "<p>$num_results reservation(s) found !</p>";
            echo "<table border='1>' style='text-align:right'";
            echo    "<tr>  <th>Reservation#   </th><th>Date From  </th><th>Date To  </th><th>Adults  </th><th>Child  </th>
                    <th>First Name </th><th>Last Name </th> <th> Modify </th>   <th> Delete </th></tr>";
                     
            
            for($i = 0; $i < $num_results;$i++)
                {
                    $row = $result->fetch_assoc();
                    
                    echo "<tr>";
                 
                    echo "<td>" . $row['reservation'] . "</td>";
                    
                    echo "<td>" . $row['checkin'] . "</td>";
                    
                    echo "<td>" . $row['checkout'] . "</td>";
                    
                    echo "<td>" . $row['adults'] . "</td>";
                 
                    echo "<td>" . $row['children'] . "</td>";
                    
                    echo "<td>" . $row['fname'] . "</td>";
                    
                    echo "<td>" . $row['lname'] . "</td>";                   
                   
                   
                    
                    //modify reservation button
                    $url = "rezDetail.php?rez={$row['reservation']}";
                     
                    echo    "<td>
                            <form action={$url} method='post'>
                            <input type='submit' value='Modify'>
                            </form>
                            </td>";
                            
                    //delete reservation button
                    $rezNum = $row['reservation'];
                     echo   "<td>                           
                            <button onclick='deleteRez($rezNum)' value='Delete'>Delete</button>                        
                            </td>";
                                                        
                    echo "</tr>";         
                    
                }
            
            echo "</table>";
        }

}

?>

<p id="deleteMsg"></p>

<script type="text/javascript" src="ajax.js"></script>
