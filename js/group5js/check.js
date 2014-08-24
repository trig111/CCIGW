/*****************************
NOTES
 *clients side of checking usually incorporate with form

******************************/

//register checking
function doResetPassCheck(){
    
    

    var repeat_pass = document.reset_pass.repeat_pass.value;
    var userpass   = document.reset_pass.userpass.value;

   if (userpass === '') {

        alert('please enter password!'); return false;
        }

    if (repeat_pass === '') {

        alert('please enter repeat password!'); return false;

    }

   

    if (repeat_pass !== userpass) {

        alert('inconsistent password and repeat password!'); return false;

    }
      if (userpass.length < 6 || userpass.length > 30) {

        alert("password's length should be >=6 and <=30"); return false;

    }
}

function doForgetPassCheck(){
    
    var username   = document.forget_pass.username.value;

    var email       = document.forget_pass.email.value;
    
    if (username === '') {

        alert('please enter username!'); return false;

    }

    if (email === '') {

        alert('please enter Email!'); return false;

    }
    var pattern =/^\w+$/;
    if(! pattern.test(username) || username.length<3 || username.length>15 ){
     alert('invlid username format');
     return false;
    }
    
      var pattern = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;

    if (! pattern.test(email) ) {

        alert('invalid email!'); 
        return false;

    }
    
   
    
}


function doRegCheck()

{

    var username   = document.register.username.value;

    var userpass   = document.register.userpass.value;

    var repeat_pass = document.register.repeat_pass.value;

    var email       = document.register.email.value;
    
    var phonenumber= document.register.phonenumber.value;
    var firstname= document.register.firstname.value;
    var lastname= document.register.lastname.value;
    var address= document.register.address.value;

     

    if (username === '') {

        alert('please enter username!'); return false;

    }

    if (userpass === '') {

        alert('please enter password!'); return false;
        }

    if (repeat_pass === '') {

        alert('please enter repeat password!'); return false;

    }

    if (email === '') {

        alert('please enter Email!'); return false;

    }

    if (repeat_pass !== userpass) {

        alert('inconsistent password and repeat password!'); return false;

    }
    var pattern =/^\w+$/;
    if(! pattern.test(username) || username.length<3 || username.length>15 ){
     alert('invlid username format');
     return false;
    }
      
    if(phonenumber!==''){
        var pattern = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        if (! pattern.test(phonenumber) ) {
        alert('invalid phonenumber!'); 
        return false;
    }
        
    }
   var pattern = /^[a-z]+$/i;
    if(lastname!==''){
        
        if (! pattern.test(lastname) ) {
        alert('invalid lastname!'); 
        return false;
    }
        
    }
    
     if(firstname!==''){
        
        if (! pattern.test(firstname) ) {
        alert('invalid firstname!'); 
        return false;
    }
        
    }
    
    if(address.length>=255){
        alert("address'length should be  <255"); return false;
        
    }


       if (userpass.length < 6 || userpass.length > 30) {

        alert("password's length should be >=6 and <=30"); return false;

    }

    var pattern = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;

    if (! pattern.test(email) ) {

        alert('invalid email!'); 
        return false;

    }
    
    else return true;
    

}
    function doLoginCheck()//login check

{

    var username   = document.login.username.value;

    var userpass         = document.login.userpass.value;
     

    if (username === '') {

        alert('please enter username!'); return false;

    }
   
    var pattern =/^\w+$/;
    if(! pattern.test(username) || username.length<3 || username.length>15 ){
     alert('invlid username format');
     return false;
    }

    if (userpass === '') {

        alert('please enter password!'); return false;
        }
        
         if (userpass.length < 6 || userpass.length > 30) {

        alert("password's length should be >=6 and <=30"); return false;

    }
    
   
        

}

//update checking allowing mutiple del and update only with those check box are checked
 function UserUpdateCheck(uid) {
  var attr = new Array(
                        "uid"+uid,
                       "accessid"+uid,    
                        "username"+uid,    
                        "userpass"+uid,    
                        "email"+uid,        
                        "firstname"+uid,   
                        "lastname"+uid,     
                        "gender"+uid,      
                        "phonenumber"+uid, 
                        "address"+uid,      
                        "status"+uid,       
                        "lastlogin"+uid,   
                        "identifier"+uid,   
                        "expiry_time"+uid  );

  var c="c"+uid;
  var isTrue=true;

 
  
  if(document.getElementById(c).checked)isTrue=false;
               
  for (var i = 0; i < attr.length; i++) document.getElementById(attr[i]).disabled=isTrue;
                
}




        



