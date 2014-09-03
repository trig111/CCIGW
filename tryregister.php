<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';

if(is_user_logged_in()){
    redirect('you are logged in, to sign up a new account , you have to log out first', 'logout.php', 'Log Out', 3,false);
        exit();
}


$css=array();

$js=array('group5js/check.js','group5js/checkName.js');
getHeader("Home",$css,$js);
output_page_menu();
echo <<< zzeof
<div style="width:40%;margin:0 auto;">
<h1>Register</h1>

    <div class="form-group"></div>

    
<form name="register" class="login_and_signup" method="post" action="register.php" onSubmit="return doRegCheck();">
      

                    <input name="username" class="form-control" placeholder="Enter username" type="text" id="username" onblur="checkNameAndEmail('name')"> </td>
                        
                    <br>
                    <input name="userpass" class="form-control" placeholder="Enter Password(&gt;=6and&lt;=30):" type="password" id="userpass">

                  <br>

                    <input name="repeat_pass" type="password" id="repeat_pass" class="form-control" placeholder="Repeat Password:">

              <br>

                     <input name="email" class="form-control" placeholder="Email" type="text" id="email" onblur="checkNameAndEmail('email')">
                    
<br>

                    <input name="firstname" type="text" class="form-control" placeholder="First Name：(optional)" id="firstname">
                    
<br>

                    <input name="lastname" type="text" id="lastname" class="form-control" placeholder="Last Name：(optional)">

                    <br>
                        
                         <label>Gender：</label>
                             
                        <label><input type="radio" name="gender" value="m" checked >Male</label>
                        <label><input type="radio" name="gender" value="f">Female</label>
                      

                      <br>

                    <input name="phonenumber" type="text" id="phonenumber" class="form-control" placeholder="Phone Number(xxx-xxx-xxxx):(optional)">

                    
<br>
                    

                    <input name="address" type="text" id="address" class="form-control" placeholder="Address:(optional)">

                 
<br>
                      <button type="submit" class="btn btn-default" name="Submit" value="Submit">Submit</button>

                    <button type="reset" class="btn btn-default" name="Reset" value="Reset">Reset</button>
  


</form>
</div>


zzeof;
getFooter();

?>
