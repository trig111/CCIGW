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
getHeader("Home",'',$js,'',0);
output_page_menu();
echo <<< zzeof

<h1>Forget Password?</h1>
<div class="responsive-container">
    <div class="dummy"></div>

    <div class="form-container">
        <div class="centerer"></div>
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

                        <td colspan="2" align="center">

                        <input type="submit" name="Submit" value="Submit">

                        <input type="reset" name="Reset" value="Reset"></td>

                        </tr>
  
</div>
               
</table>
 </fieldset>

</form>



zzeof;
getFooter();

?>
