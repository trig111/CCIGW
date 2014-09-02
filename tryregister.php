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

    <div class="dummy"></div>

    
<form name="register" class="login_and_signup" method="post" action="register.php" onSubmit="return doRegCheck();">
            <fieldset>
                <table >

                    <tr>

                        <td >Username：</td>

                        <td><input name="username" type="text" id="username" onblur="checkNameAndEmail('name')"> </td>
                        <div id="php100"></div>
                    </tr>

                    <tr>

                        <td>Password(&gt;=6and&lt;=30)：</td>

                        <td><input name="userpass" type="password" id="userpass"></td>

                    </tr>

                    <tr>

                        <td>Repeat Password：</td>

                        <td><input name="repeat_pass" type="password" id="repeat_pass"></td>

                    </tr>
                    
                     <tr>

                        <td>Email:</td>

                         <td><input name="email" type="text" id="email" onblur="checkNameAndEmail('email')"></td>

                    </tr>

                    <tr>

                        <td>First Name：(optional)</td>

                        <td><input name="firstname" type="text" id="firstname"></td>
                    </tr>
                    
                     <tr>

                        <td>Last Name：(optional)</td>

                        <td><input name="lastname" type="text" id="lastname"></td>

                    </tr>
                        
                         <td>Gender：
                         <br/>    
                        <label><input type="radio" name="gender" value="m" checked >Male</label>
                        <label><input type="radio" name="gender" value="f">Female</label>
                        </td>

                    <tr>

                        <td>Phone Number(xxx-xxx-xxxx):(optional)</td>

                         <td><input name="phonenumber" type="text" id="phonenumber"></td>

                    </tr>
                    
                    <tr>

                        <td>Address:(optional)</td>

                         <td><input name="address" type="text" id="address"></td>

                    </tr>

                   

                    <tr>

                        <td colspan="2" align="center">

                        <input type="submit" name="Submit" value="Submit">

                        <input type="reset" name="Reset" value="Reset"></td>

                        </tr>
  
               
</table>
 </fieldset>

</form>
</div>


zzeof;
getFooter();

?>
