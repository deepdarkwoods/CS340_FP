


function addtoCart(o,room)
{
    
  if (room.length == 0) { return;}
              
else
    {
        //toggle button between reserved and available
        if(o.innerHTML == "Reserve")
           {               
                o.innerHTML = "Added";
                o.style.color = "red"; 
            }
           
       else 
            {
                o.innerHTML = "Reserve";
                o.style.color = "black";            
            }
    
       var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function()
                
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                           document.getElementById("cart").innerHTML = xmlhttp.responseText;
                        }
                    }
            if(o.innerHTML == "Reserve")
                {
                        xmlhttp.open("GET", "cart.php?remove=" + room, true);
                        xmlhttp.send();
                }
            else
                {
                        xmlhttp.open("GET", "cart.php?add=" + room, true);
                        xmlhttp.send();   
                    
                }
    
    }
    
    
}