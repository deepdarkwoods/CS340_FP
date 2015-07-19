<?php
error_reporting(E_ALL);

$rez = $_GET["rezToDelete"];


//connect to mySQL
/*******************************************/
$db = new mysqli('localhost','brad','brad','hotel');
if($db->connect_errno)
    {
        echo "Failed to Connect to Server. Server Error -> " . $db->connect_errno;
    }
/*******************************************/



/****  Delete from Relational Table First ' reservations_roooms'   ******/

$stmt1 =     "DELETE FROM reservations_rooms
            WHERE resid = $rez";

$deleteRT = $db->query($stmt1);
if($deleteRT === FALSE) {echo "Problem encountered with deleting reservation";}





/****  Delete reservation from  'reservations'   ******/

$stmt2 =    "DELETE FROM reservations
            WHERE reservation = $rez";
$deleteReservation = $db->query($stmt2);
if($deleteReservation === FALSE)
    {echo "Problem encountered with deleting reservation";}
else
    {echo "Deletion Successful !";}









?>