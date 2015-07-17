<?php
session_start();
error_reporting(E_ALL);
include 'header.php';

//create short variables
$roomList = $_SESSION["roomsselected"];
$inDate = $_SESSION["checkin"];
$outDate = $_SESSION["checkout"];
$firstN = $_POST["First_Name"];
$lastN = $_POST["Last_Name"];
$street = $_POST["Street"];
$city = $_POST["City"];
$state = $_POST["State"];
$zip = $_POST["Zip"];
$email = $_POST["Email"];
$phone = $_POST["Phone"];
$adults = $_POST["Adults"];
$child = $_POST["Children"];



$db = new mysqli('localhost','brad','brad','hotel');
if($db->connect_errno)
    {
        echo "Failed to Connect to Server. Server Error -> " . $db->connect_errno;
    }
   
   
    
 /**** Add Customer to Table 'guest' ****/   
$addGuest = "INSERT INTO guest
             (fname,lname,street,city,state,zip,email,phone)
             VALUES
             ('{$firstN}','{$lastN}','{$street}','{$city}','{$state}','{$zip}','{$email}','{$phone}')
            ";
$result = $db->query($addGuest);
if($result === FALSE)
        {echo "Error number $db->errno"; }    
else
        {echo "Guest Added Successfully !<br>"; }
        
        
        
        
        
/****   FIND THE ASSIGNED GUEST ID  ****/
$findGuestID ="SELECT guest.id
               FROM guest
               WHERE guest.fname = '{$firstN}' AND guest.lname = '{$lastN}' and guest.email = '{$email}'
               ";
$result2 = $db->query($findGuestID);
$ID = $result2->fetch_assoc();
if($result2 === FALSE)
        {echo "Error number $db->errno"; }    
else
        {echo $firstN . " " . $lastN . " , your Guest Number is " . $ID['id'] . "<br>" ; }
        



/**** Add Reservation to Table 'reservations'*/
$addRez = "INSERT INTO reservations
           (guestid,checkin,checkout,adults,children)
           VALUES
           ('{$ID['id']}','{$inDate}','{$outDate}','{$adults}','{$child}')            
            ";
$result3 = $db->query($addRez);
if($result3 === FALSE)
        {echo "Error number $db->errno"; }
        
        

/*** Find New Reservation # for Guest ***/         
$findRez =  "SELECT reservation
        FROM reservations
        WHERE guestid = '{$ID['id']}' AND checkin = '{$inDate}' AND checkout = '{$outDate}'
        ";
$result4 = $db->query($findRez);

$RezNum = $result4->fetch_assoc();
if($RezNum === FALSE)
        {echo "Error number $db->errno"; }    
else
        {echo "Your Reservation # is " . $RezNum['reservation'] ; }     
            
            
            
         
            
 /**** Add to reservations_rooms ******/
 $num_rooms = count($roomList);
 
    foreach($roomList as $value)
    {
    $addrelation = "INSERT INTO reservations_rooms
                   (resid,roomid)
                   VALUES
                   ('{$RezNum['reservation']}','{$value}')
                   ";
   
    $result5 = $db->query($addrelation);               
    if($result5 === FALSE){echo "relation not added <br>";}
    }    
        
        
        
        
        
        
        
        
        
    
    
?>