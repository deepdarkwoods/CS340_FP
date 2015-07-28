<?php
error_reporting(E_ALL);
include 'header.php';
include 'connection.php';

$checkinDate = $_POST["checkin"];
$checkoutDate = $_POST["checkout"];





$stmt1 = "SELECT room,price,floor,sqft,beds FROM rooms";
$result = $db->query($stmt1);
$num_results = $result->num_rows;

echo "<p>$num_results rooms found !</p>";


echo "<table border='1>' style='text-align:right'";
echo "<tr>  <th>Room    </th><th>Floor  </th><th>Sq Ft  </th><th>Beds  </th><th>Price  </th>    </tr>";

for($i = 0; $i < $num_results;$i++)
    {
        $row = $result->fetch_assoc();
        
        echo "<tr>";
        //room #
        echo "<td>" . $row['room'] . "</td>";
         //Floor
        echo "<td>" . $row['floor'] . "</td>";
         //Sqft
        echo "<td>" . $row['sqft'] . "</td>";
         //Beds
        echo "<td>" . $row['beds'] . "</td>";
         //Price
        echo "<td>$ " . $row['price'] . "</td>";
        echo "</tr>";      
        
        
    }

echo "</table>";


?>