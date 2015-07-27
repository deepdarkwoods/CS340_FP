<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

include 'header.php';



//HomePage for Hotel Workers
?>



<html>
<body>     
    
    <form action="searchRooms.php" method="post">
        <fieldset><legend>Add a Reservation</legend>
        Check-In Date:<br>
        <input type="date" name="checkin" required><br>
        Check-Out Date:<br>
        <input type="date" name="checkout" required><br>
        <input type="submit" name="Submit" value="Search">
        </fieldset> 
    </form><br>
    
      <form action="searchRES.php" method="post">
        <fieldset><legend>View / Modify Reservations</legend>
        Enter Reservation #:<br>
        <input type="text" name="searchNum"><br>   
         Enter Last Name:<br>
        <input type="text" name="searchName"><br>
        <input type="submit" name="Submit" value="Search">
        </fieldset> 
    </form><br>

</body>
</html>



<?php
if(isset($_GET["changes"]))
    {
        echo "Update Successful !";
    }
?>




