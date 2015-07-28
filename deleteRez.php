<?php
error_reporting(E_ALL);
include 'connection.php';

$rez = $_GET["rezToDelete"];




/****  Delete credit card tied to reservation   ******/

$stmt3 =     "DELETE FROM creditcards
            WHERE resid = $rez";

$deleteCC = $db->query($stmt3);
if($deleteCC === FALSE) {echo "Problem encountered with deleting credit card";}






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