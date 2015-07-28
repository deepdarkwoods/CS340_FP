<?php
error_reporting(E_ALL);
include 'header.php';
include 'connection.php';



if(!isset($_GET['go']))
    {
       header('Location: user.php?changes=yes');
    }

$cc = $_GET['cc'];



//user can update any field in the creditcards table
$stmt = "SELECT cardnumber,expdate,fname,lname
        FROM creditcards
        WHERE cardnumber = '{$cc}'";
        
$result = $db->query($stmt);
$row = $result->fetch_assoc();

?>

<h2>Change Credit Card</h2>
<form action="changeCC.php?" method="GET">
    <input type="text" name="Card" value="<?php echo $row['cardnumber']?>" required>Card Number<br>
    <input type="date" name="Exp" value="<?php echo $row['expdate']?>" required>Expiration Date<br>
    <input type="text" name="First" value="<?php echo $row['fname']?>" required>First Name<br>
    <input type="text" name="Last" value="<?php echo $row['lname']?>" required>Last Name<br>    
    <input type="hidden" name="cc" value="<?php echo $cc ?>" >
    <input type="submit" name="Submit" <br>
</form>

<?php

if(isset($_GET["Submit"]))
    {
    
        $stmt2 =    "UPDATE creditcards
                    SET cardnumber='{$_GET['Card']}',
                    expdate='{$_GET['Exp']}',
                    fname='{$_GET['First']}',
                    lname='{$_GET['Last']}'                
                    WHERE cardnumber = '{$cc}'";
                        
         $result2 = $db->query($stmt2);
         
         if($result2 == FALSE) {echo "Not Updated";}
    }

?>
