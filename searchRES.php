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
        $stmt1 =    "SELECT reservation,checkin,checkout,adults,children,fname,lname,room,price,floor,sqft,beds
                    FROM guest
                    INNER JOIN reservations ON guest.id = reservations.guestid
                    INNER JOIN reservations_rooms ON reservations.reservation = reservations_rooms.resid
                    INNER JOIN rooms ON reservations_rooms.roomid = rooms.room
                    WHERE reservation = $searchNum";
         $result = $db->query($stmt1);
         showResults($result);     
        
    }

//user has entered a last name to search
elseif(isset($_POST["searchName"]) && $_POST["searchName"] !="")
    {
        
        $searchName = ($_POST["searchName"]);        
        $stmt1 =    "SELECT reservation,checkin,checkout,adults,children,fname,lname,room,price,floor,sqft,beds
                    FROM guest
                    INNER JOIN reservations ON guest.id = reservations.guestid
                    INNER JOIN reservations_rooms ON reservations.reservation = reservations_rooms.resid
                    INNER JOIN rooms ON reservations_rooms.roomid = rooms.room
                    WHERE lname = '{$searchName}'";
         $result = $db->query($stmt1);
         showResults($result);        
        
    }

//show all reservations ascending order by last name
else
//
    {

        $stmt1 =    "SELECT reservation,checkin,checkout,adults,children,fname,lname,room,price,floor,sqft,beds
                    FROM guest
                    INNER JOIN reservations ON guest.id = reservations.guestid
                    INNER JOIN reservations_rooms ON reservations.reservation = reservations_rooms.resid
                    INNER JOIN rooms ON reservations_rooms.roomid = rooms.room
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
                    <th>First Name </th><th>Last Name </th>
                    <th>Room </th>  <th>Price </th> <th>Floor </th> <th>Sq Ft </th>   <th>Beds </th>  </tr>";
            
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
                    
                    echo "<td>" . $row['room'] . "</td>";
                    
                    echo "<td>$ " . $row['price'] . "</td>";
                    
                    echo "<td>" . $row['floor'] . "</td>";
                    
                    echo "<td>" . $row['sqft'] . "</td>";
                    
                    echo "<td>" . $row['beds'] . "</td>";
                    
                    echo "</tr>";         
                    
                }
            
            echo "</table>";
        }

}

?>