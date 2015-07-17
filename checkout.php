<?php
session_start();
error_reporting(E_ALL);
include 'header.php';
$roomList = $_SESSION["roomsselected"];


//connect to mySQL server
$db = new mysqli('localhost','brad','brad','hotel');
if($db->connect_errno)
    {
        echo "Failed to Connect to Server. Server Error -> " . $db->connect_errno;
    }
    
      

$stmt1 = "      SELECT room,price,floor,sqft,beds
                FROM rooms                
                WHERE room IN
                (".implode(',',$roomList).")                
               
        ";
        
$stmt2 = "      SELECT SUM(price) as total
                FROM rooms                
                WHERE room IN
                (".implode(',',$roomList).")                
               
        ";
             
          

$result = $db->query($stmt1);
$result2 = $db->query($stmt2);

if($result === FALSE || $result2 === FALSE )
    {
         echo "Error number $db->errno";   
    }
else
         
          
    {
        $num_results = $result->num_rows;
        
        echo "<p>$num_results room(s) in cart.</p>";
        
        
        
        echo "<table border='1'  style='text-align:right'";     
        echo "<tr>  <th>Room    </th><th>Floor  </th><th>Sq Ft  </th><th>Beds  </th><th>Price  </th>   </tr>";
        
        for($i = 0; $i < $num_results;$i++)
            {
                $row = $result->fetch_assoc();
                
                echo "<tr>";
               
                echo "<td>" . $row['room'] . "</td>";
               
                echo "<td>" . $row['floor'] . "</td>";
               
                echo "<td>" . $row['sqft'] . "</td>";
                
                echo "<td>" . $row['beds'] . "</td>";
             
                echo "<td>$ " . $row['price'] . "</td>";             
               
                echo "</tr>";      
                
                
            }
                //Total Price of Cart
                $totalrow = $result2->fetch_assoc();
                echo "<tr>  <td colspan='4'>Total:</td>     <td>{$totalrow['total']}</td>  </tr> <br>";
        
        echo "</table><br>";
    }
?>


<h1>Checkout Screen</h1><br>
<h2>Add Customer Information</h2>
<form action="confirmed.php" method="POST">
    <input type="text" name="First_Name" required>First Name<br>
    <input type="text" name="Last_Name" required>Last Name<br>
    <input type="text" name="Street" required>Street<br>
    <input type="text" name="City" required>City<br>
    <input type="text" name="State" required>State<br>
    <input type="text" name="Zip" required>Zip<br>
    <input type="email" name="Email" required>Email<br>
    <input type="text" name="Phone" required>PhoneNumber<br>
    <p>How many Guests will Arrive ?</p>
    <input type="number" name="Adults" required>Adults<br>
    <input type="number" name="Children" required>Children<br>
    <p>Credit Card Info</p>
    <input type="text" name="Credit_Card" required>Credit Card Number<br>
    <input type="date" name="Exp_Date" required>Expiration Date<br>
    <input type="fname" name="CCfname" required>First Name on Card<br>
    <input type="fname" name="CClname" required>Last Name on Card<br>
    
<input type="submit" name="Submit" required><br>
</form>
    
    

    
    



