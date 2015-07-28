<?php
error_reporting(E_ALL);
include 'connection.php';


$room = $_GET["room"];
$res = $_GET["rez"];

  
  
//Remove reservation from Relationship Table to rooms. 
$stmt = "DELETE 
        FROM reservations_rooms
        WHERE resid = '{$res}' AND roomid = '{$room}'";
        
$result = $db->query($stmt);

if ($result == FALSE)
    {echo "Delete was not completed.";}



//Show Updated Table after Ajax Request 
else
    {
        $stmt1 =    "SELECT reservation,checkin,checkout,adults,children,fname,lname,room,price,floor,sqft,beds
                    FROM guest
                    INNER JOIN reservations ON guest.id = reservations.guestid
                    INNER JOIN reservations_rooms ON reservations.reservation = reservations_rooms.resid
                    INNER JOIN rooms ON reservations_rooms.roomid = rooms.room
                    WHERE reservation = $res";
                
        $result2 = $db->query($stmt1);       
            
        showResults($result2,$res);        
    }     
        
        
        
//Displays reservation result set
function showResults($result2,$res)
        {
            $num_results = $result2->num_rows;
            if($num_results == 0 )
            
                {
                    echo "No Results Found !";
                }
                
            else
                {
                    
                    
                    echo    "<table border='1' style='text-align:right' class='table'";
                    echo    "<tr>  <th>Room </th>  <th>Price </th> <th>Floor </th> <th>Sq Ft </th>   <th>Beds </th> <th>Delete </th> </tr>";
                    
                    for($i = 0; $i < $num_results;$i++)
                        {
                            $row = $result2->fetch_assoc();
                            
                            echo "<tr>";
                            
                            echo "<td>" . $row['room'] . "</td>";           $room = $row['room'];
                            
                            echo "<td>$ " . $row['price'] . "</td>";
                            
                            echo "<td>" . $row['floor'] . "</td>";
                            
                            echo "<td>" . $row['sqft'] . "</td>";
                            
                            echo "<td>" . $row['beds'] . "</td>";      
        
                            echo "<td> <button onclick='deleteRoom($room,{$res})' value='Delete'> Delete </button> </td>";
                            
                            echo "</tr>";         
                            
                        }
                    
                    echo "</table>";
                    
                }
                
              
        
        }

    
?>