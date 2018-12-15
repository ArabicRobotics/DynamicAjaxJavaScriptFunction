<script>
function RunPhp(serverFile=null,controlId=null,attName='', callId='',device='robot',async=true,timeout='5000') {
    document.getElementById("divglobalstatuscontent").innerHTML="loading..";
    addLog("I am at RunPhp"+serverFile);
  if (serverFile==''|| serverFile==null) {
      addLog ("RunPhp : ServerFile Empty");
      return;
  }        
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

        xmlhttp.ontimeout = function () {
        addLog("The request TimeOut  "+serverFile);
             document.getElementById("divglobalstatuscontent").innerHTML="time out";
    };
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
        var address= this.responseText;
        if(attName=='')
            {
        if(controlId !=''&& controlId)
            {  
                document.getElementById(controlId).innerHTML = this.responseText; 
            }
            }
        else
            {
                 document.getElementById(controlId).setAttribute(attName,this.responseText);
                
            }
         addLog("RunPhp: "+callId+"STATUS="+this.status+",VALUE="+this.responseText);
        
        switch(device)
            {
                    case("robot"):
                    document.getElementById("divrobotstatusbar").innerHTML = this.responseText;
                    break;
                    case("cam"): 
                    document.getElementById("divcamstatusbar").innerHTML = this.responseText;
                    break;
                    case("led"):
                    document.getElementById("divledstatusbar").innerHTML = this.responseText;
                    break;
                    case('notification'):
                    break;
                    case("move"):
                        document.getElementById("divmovestatusbar").innerHTML = this.responseText;
                    break;
                    case('global'):
                    break;
                default:
                    document.getElementById("divglobalstatuscontent").innerHTML=this.responseText;         
            }
         document.getElementById("divglobalstatuscontent").innerHTML="Success call"; 
        
     return true;
    }
      else{
          
          //request failed.
          //document.getElementById("divglobalstatuscontent").innerHTML="...";
      }
  }
  xmlhttp.open("GET",serverFile,async);
  xmlhttp.timeout=timeout;
  xmlhttp.send();
}
/////////// end Ajax Function RunPhp/////////////  
</script>
