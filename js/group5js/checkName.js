/* 
 * 
 */


var xmlHttp;
    function S_xmlhttprequest(){
        if(window.ActiveXobject){
            xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
        }else if(window.XMLHttpRequest){
            xmlHttp = new XMLHttpRequest();
        }
    }
    function checkNameAndEmail(isName){
    		if(isName=="name") var f = document.getElementById('username').value;//get the contents of the box
    		else f = document.getElementById('email').value;
        S_xmlhttprequest();
        xmlHttp.open("GET","jcfor.php?id="+f+"&filed="+isName,true);//request
        xmlHttp.onreadystatechange = byphp;//ready
        xmlHttp.send(null);//send
        	return true;
    }
    function byphp(){
        //judge
        //
        //}
        if(xmlHttp.readyState==4){//check AJAX
           if(xmlHttp.status==200){//check service 
               var byphp100 = xmlHttp.responseText;
               //alert(byphp100);
               document.getElementById('php100').innerHTML = byphp100;  
           }   
        }
           
    }
 
