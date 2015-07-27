<?php
error_reporting(E_ALL);
include 'header.php';

if(!isset($_GET['go']))
    {
        header('Location: user.php');
    }

$id = $_GET['id'];



//CONNECT TO SERVER
/*******************************************/
$db = new mysqli('localhost','brad','brad','hotel');
if($db->connect_errno)
    {
        echo "Failed to Connect to Server. Server Error -> " . $db->connect_errno;
    }
/*******************************************/





//updates contact information for guest
$stmt = "SELECT fname,lname,street,city,state,zip,email,phone
        FROM guest
        WHERE guest.id = '{$id}'";
        
$result = $db->query($stmt);

$row = $result->fetch_assoc();
?>


<h2>Change Customer Information</h2>
<form action="changeGuest.php?" method="GET">
    <input type="text" name="First_Name" value="<?php echo $row['fname']?>" required>First Name<br>
    <input type="text" name="Last_Name" value="<?php echo $row['lname']?>" required>Last Name<br>
    <input type="text" name="Street" value="<?php echo $row['street']?>" required>Street<br>
    <input type="text" name="City" value="<?php echo $row['city']?>" required>City<br>
    <input type="text" name="State" value="<?php echo $row['state']?>" required>State<br>
    <input type="text" name="Zip" value="<?php echo $row['zip']?>" required>Zip<br>
    <input type="email" name="Email" value="<?php echo $row['email']?>" required>Email<br>
    <input type="text" name="Phone" value="<?php echo $row['phone']?>" required>PhoneNumber<br>
    <input type="hidden" name="id" value="<?php echo $id ?>" >
<input type="submit" name="Submit" required><br>
</form>

<?php


if(isset($_GET["Submit"]))
    {
        $stmt2 =    "UPDATE guest
                    SET fname='{$_GET['First_Name']}',lname='{$_GET['Last_Name']}',
                        street='{$_GET['Street']}',city='{$_GET['City']}',
                        state='{$_GET['State']}',zip='{$_GET['Zip']}',
                        email='{$_GET['Email']}',phone='{$_GET['Phone']}'
                        WHERE guest.id = '{$id}'";
                        
         $result2 = $db->query($stmt2);
         
         if($result2 == FALSE) {echo "Not Updated";}
    }



?>






