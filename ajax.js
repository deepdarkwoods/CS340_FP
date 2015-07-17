

function addtoCart(room)
  {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("cart").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "cart.php?addCart=" + room, true);
        xmlhttp.send();
    
    
  }
  
  
  
  
  