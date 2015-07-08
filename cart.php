<?php
session_start();

if(isset($_GET["add"]))

    {
        if(!isset($_SESSION["cart"]))
            {
                $_SESSION["cart"] = array();
                array_push($_SESSION["cart"],$_GET["add"]);
            }
        else
            {
                array_push($_SESSION["cart"],$_GET["add"]);
                showCart();
            }
    
    }

if(isset($_GET["remove"]))

    {
        
        $index = array_search($_GET["remove"], $_SESSION["cart"]);
        if($index !== false)
            {
                unset($_SESSION["cart"][$index]);
            }
        showCart();
    }



function showCart ()
    {
        foreach($_SESSION["cart"] as $room)
            {
                echo $room . "<br>";
            }
     
    }









?>