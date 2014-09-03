function isChecked_user(uid){
var attr = new Array(
                        "uid"+uid,
                       "accessid"+uid,    
                        "username"+uid,
                        "email"+uid,
                        "lastname"+uid, 
                        "firstname"+uid,     
                        "gender"+uid,      
                        "phonenumber"+uid, 
                        "address"+uid,      
                        "status"+uid,         
                        "identifier"+uid
                          );

  var c="checkbox"+uid;
  
 
  if(document.getElementById(c).checked){
        for (var i = 0; i < attr.length; i++){
            document.getElementById(attr[i]).disabled=false;
        }
     document.getElementById(attr[0]).readOnly=true;
   } 
   else{
        document.getElementById(attr[0]).readOnly=false;
           for (var i = 0; i < attr.length; i++){
            document.getElementById(attr[i]).disabled=true;
        }
   }
  

}

function isChecked_userAccess(accessid){
var attr = new Array( 
                       "accessid"+accessid,    
                        "readaccess"+accessid,
                        "allowview"+accessid,
                        "allowpost"+accessid, 
                        "allowreply"+accessid,  
                         "allowsearch"+accessid,
                          "allowupdate"+accessid,
                        "allowdelete"+accessid,      
                        "allowgetattach"+accessid, 
                        "allowpostattach"+accessid,      
                        "allowsetreadperm"+accessid,         
                        "type"+accessid
                          );
  var c="checkbox"+accessid;
  
 
  if(document.getElementById(c).checked){
        for (var i = 0; i < attr.length; i++){
            document.getElementById(attr[i]).disabled=false;
        }
     document.getElementById(attr[0]).readOnly=true;
   } 
   else{
        document.getElementById(attr[0]).readOnly=false;
           for (var i = 0; i < attr.length; i++){
            document.getElementById(attr[i]).disabled=true;
        }
   }
}