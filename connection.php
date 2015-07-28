<?php
//CONNECT TO SERVER
/*******************************************/
//$db = new mysqli('localhost','brad','brad','hotel');
$db = new mysqli('oniddb.cws.oregonstate.edu','parkerb2-db','RznqNou9jGnYkUSh','parkerb2-db');

if($db->connect_errno)
    {
        echo "Failed to Connect to Server. Server Error -> " . $db->connect_errno;
    }
/*******************************************/
?>