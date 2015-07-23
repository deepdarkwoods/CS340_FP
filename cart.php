<?php
session_start();
error_reporting(E_ALL);
if(!isset($_SESSION["roomsselected"]))
    {
       $_SESSION["roomsselected"] = array();
    }



if(isset($_SESSION["roomsselected"]))
{
    echo    "<form action='checkout.php' method='post' >";
    echo    "<input type='submit' value='Checkout' > "  ;
    echo    "</form>";
}



 
    
//Check if room is already in cart
    
    if(isset($_GET["addCart"]))
       {
        
       echo "<table border='1' class='cartTable'>";
       
       echo "<tr><th>Room Reserved</th></tr><br>";
       
       if(!in_array($_GET["addCart"],$_SESSION["roomsselected"]))
          {
            array_push($_SESSION["roomsselected"],$_GET["addCart"]);
          }
       foreach($_SESSION["roomsselected"] as $row)
            {
                echo "<tr>";
                echo "<td>" . $row . "</td>" ;
                echo "</tr>";
            }
        echo "</table border>";
       }




?>