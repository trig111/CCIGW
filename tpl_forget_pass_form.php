<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';
require_once("include/demoframe.php");
//do_page_prerequisites();



//$css=array('layout.css', 'slideshow.css');

$js=array('group5js/check.js','group5js/checkName.js');
getHeader("Home",'',$js);
output_page_menu();
echo <<< zzeof
<div style="width:40%;margin:0 auto;">
<h1>Forget Password?</h1>

    <div class="dummy"></div>

    
<form name="forget_pass" class="login_and_signup" method="post" action="server_process_forget_pass.php" onSubmit="return doForgetPassCheck();">
            <fieldset>
                <table >

                    <tr>

                        <td >Username：</td>

                        <td><input name="username" type="text" id="username" onblur="checkNameAndEmail('name')"> </td>
                        <div id="php100"></div>
                    </tr>

                    
                    
                     <tr>

                        <td>Email:</td>

                         <td><input name="email" type="text" id="email" onblur="checkNameAndEmail('email')"></td>

                    </tr>
                            
                    <tr>
<br /><br />
                        <td colspan="2" align="center">
                        <br /><br />
                        <input type="submit" name="Submit" value="Submit">

                        <input type="reset" name="Reset" value="Reset"></td>

                        </tr>

               
</table>
 </fieldset>

</form>
</div>
<br /><br />

zzeof;
getFooter();

?>
