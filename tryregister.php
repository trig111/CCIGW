<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';
require_once("include/demoframe.php");
//do_page_prerequisites();



$css='';

$js=array('group5js/check.js','group5js/checkName.js');
getHeader("Home",$css,$js,'',0);
output_page_menu();
echo <<< zzeof

<h1>Register</h1>
<div class="responsive-container">
    <div class="dummy"></div>

    <div class="form-container">
        <div class="centerer"></div>
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
  </div>
</div>
               
</table>
 </fieldset>

</form>



zzeof;
getFooter();

?>
