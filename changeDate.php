<?php
error_reporting(E_ALL);
include 'header.php';

if(!isset($_GET['go']))
    {
        header('Location: user.php?changes=yes');
    }

$rez = $_GET['rez'];


//CONNECT TO SERVER
/*******************************************/
$db = new mysqli('localhost','brad','brad','hotel');
if($db->connect_errno)
    {
        echo "Failed to Connect to Server. Server Error -> " . $db->connect_errno;
    }
/*******************************************/
  


//changes the reservation date for the hotel guest
$stmt = "SELECT checkin,checkout
        FROM reservations
        WHERE reservation = '{$rez}'";
        
$result = $db->query($stmt);

$row = $result->fetch_assoc();


?>

<h2>Change Dates</h2>
<form action="changeDate.php?" method="GET">
    <input type="date" name="Check_In" value="<?php echo $row['checkin']?>" required>Check In Date<br>
    <input type="date" name="Check_Out" value="<?php echo $row['checkout']?>" required>Check Out Date<br>
    <input type="hidden" name="rez" value="<?php echo $rez ?>" >
    <input type="submit" name="Submit" <br>
</form>

<?php

if(isset($_GET["Submit"]))
    {
    
        $stmt2 =    "UPDATE reservations
                    SET checkin='{$_GET['Check_In']}',
                    checkout='{$_GET['Check_Out']}'                
                    WHERE reservation = '{$rez}'";
                        
         $result2 = $db->query($stmt2);
         
         if($result2 == FALSE) {echo "Not Updated";}
    }

?>


