
//User clicks on room to reserve, updates cart
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
  
  
  
  
  
//user clicks on reservatino to delete, updates mysql tables
function deleteRez(rezNum)
  {
     var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("deleteMsg").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "deleteRez.php?rezToDelete=" + rezNum, true);
        xmlhttp.send();    
  }
  
  
  

//user can delete individual rooms from a reservation  
function deleteRoom(room,rez)
  {
     var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                //document.getElementById("deleteresponse").innerHTML = xmlhttp.responseText;
                document.getElementById("replaceTable").innerHTML = xmlhttp.responseText;
                
            }
        }
        xmlhttp.open("GET", "deleteRoomfromRes.php?room="+ room + "&rez=" + rez, true);
        xmlhttp.send();    
  }
  
  
  
  