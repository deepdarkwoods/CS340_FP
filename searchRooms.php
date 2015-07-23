<?php
session_start();

error_reporting(E_ALL);
include 'header.php';

$checkinDate = $_POST["checkin"];
$checkoutDate = $_POST["checkout"];
$_SESSION["checkin"] = $checkinDate;
$_SESSION["checkout"] = $checkoutDate;

//
 echo "<div id='cart'></div>";
 
//connect to mySQL server
$db = new mysqli('localhost','brad','brad','hotel');
if($db->connect_errno)
    {
        echo "Failed to Connect to Server. Server Error -> " . $db->connect_errno;
    }
    
      

//taken from class book, page 270 Ch.11
$stmt1 = "      SELECT room,price,floor,sqft,beds
                FROM rooms                
                WHERE room NOT IN
                (SELECT room 
                FROM rooms 
                INNER JOIN reservations_rooms AS rr 
                ON rooms.room = rr.roomid 
                INNER JOIN reservations AS res 
                ON rr.resid = res.reservation 
                WHERE
                ('{$checkinDate}' < res.checkin AND '{$checkoutDate}' > res.checkin)
                OR
                ('{$checkinDate}' < res.checkout AND '{$checkoutDate}' > res.checkout))";
             
          

$result = $db->query($stmt1);


if($result === FALSE)
    {
         echo "Error number $db->errno";   
    }
else
         
          
    {
        $num_results = $result->num_rows;
        
        echo "<p>$num_results rooms found !</p>";
        
        
        
        echo "<table border='1' id='roomTable' style='text-align:right'";     
        echo "<tr>  <th>Room    </th><th>Floor  </th><th>Sq Ft  </th><th>Beds  </th><th>Price  </th>    <th>Select / Remove  </th>   </tr>";
        
        for($i = 0; $i < $num_results;$i++)
            {
                $row = $result->fetch_assoc();
                
                echo "<tr>";
               
                echo "<td>" . $row['room'] . "</td>";
               
                echo "<td>" . $row['floor'] . "</td>";
               
                echo "<td>" . $row['sqft'] . "</td>";
                
                echo "<td>" . $row['beds'] . "</td>";
             
                echo "<td>$ " . $row['price'] . "</td>";
                
                echo "<td ><button type='button' onclick='addtoCart({$row['room']})' style='width:75px'>Reserve</button></td>";
               
                echo "</tr>";      
                
                
            }
        
        echo "</table><br>";
       
    }





?>


<script type="text/javascript" src="ajax.js"></script>