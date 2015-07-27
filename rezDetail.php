<?php
error_reporting(E_ALL);
include 'header.php';


//create short variable names
$id = $_GET["guestid"];
$rez = $_GET["rez"];
$in=$_GET["in"];
$out=$_GET["out"];
$fname=$_GET["fname"];
$lname=$_GET["lname"];
$cc = $_GET["cc"];



//edit contact info for guest
echo "<h1>Reservation # ". $rez . "</h1>" ;
echo "<form action='changeGuest.php?id={$id}&go=1' method='post'>";
echo "<input type='submit' value='edit'>";
echo " Guest Name: " . $fname . " " . $lname . " ";
echo "</form><br>";



//change reservation details
echo "<form action='changeDate.php?rez={$rez}&go=1' method='post'>";
echo "<input type='submit' value='edit'>";
echo " Date: From " . $in . " to " . $out . " " ;
echo "</form><br>";



//change credit card details
echo "<form action='changeCC.php?cc={$cc}&go=1' method='post'>";
echo "<input type='submit' value='edit'>";
echo " Card Number: ".  $cc . " " ;
echo "</form><br>";



//Connect to mySQL Server
/*******************************************/
$db = new mysqli('localhost','brad','brad','hotel');
if($db->connect_errno)
    {
        echo "Failed to Connect to Server. Server Error -> " . $db->connect_errno;
    }
/*******************************************/






//show reservation details
$stmt1 =    "SELECT reservation,checkin,checkout,adults,children,fname,lname,room,price,floor,sqft,beds
            FROM guest
            INNER JOIN reservations ON guest.id = reservations.guestid
            INNER JOIN reservations_rooms ON reservations.reservation = reservations_rooms.resid
            INNER JOIN rooms ON reservations_rooms.roomid = rooms.room
            WHERE reservation = $rez";
            
$result = $db->query($stmt1);

        
showResults($result,$rez); 
echo "<p id='deleteresponse'></p>";



//Displays reservation result set
function showResults($result,$rez)
{
    $num_results = $result->num_rows;
    if($num_results == 0 )
    
        {
            echo "No Results Found !";
        }
        
    else
        {
            
            echo "<div id='replaceTable'>";
            echo    "<table border='1' style='text-align:right' class='table'";
            echo    "<tr>  <th>Room </th>  <th>Price </th> <th>Floor </th> <th>Sq Ft </th>   <th>Beds </th> <th>Delete </th> </tr>";
            
            for($i = 0; $i < $num_results;$i++)
                {
                    $row = $result->fetch_assoc();
                    
                    echo "<tr>";
                    
                    echo "<td>" . $row['room'] . "</td>";           $room = $row['room'];
                    
                    echo "<td>$ " . $row['price'] . "</td>";
                    
                    echo "<td>" . $row['floor'] . "</td>";
                    
                    echo "<td>" . $row['sqft'] . "</td>";
                    
                    echo "<td>" . $row['beds'] . "</td>";      

                    echo "<td> <button onclick='deleteRoom($room,{$rez})' value='Delete'> Delete </button> </td>";
                    
                    echo "</tr>";         
                    
                }
            
            echo "</table>";
            echo "</div>";
        }
        
      

}

?>

<script type="text/javascript" src="ajax.js"></script>



