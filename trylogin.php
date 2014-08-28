<?php

/*****************************
NOTES
 * THIS CODE is generating the form for log in
******************************/

if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';
require_once("include/demoframe.php");


//$css=array('ccigw.css', 'bootstrap.css');

$js=array('group5js/check.js');
getHeader("Home",'',$js);
output_page_menu();
echo <<< zzeof
<h1>Login</h1>
<div class="responsive-container">
    <div class="dummy"></div>

    <div class="form-container">
        <div class="centerer"></div>
        
        <form clss="login_and_signup" name="login" method="post" action="login.php" onSubmit="return doLoginCheck();">

    <fieldset>
    	
 
        <table >
                
   
                    <tr>

                        <td width=>Username：</td>

                        <td><input name="username" type="text" id="username"> </td>

                    </tr>

                    <tr>

                        <td>Password(&gt;=6and&lt;=30)：</td>

                        <td><input name="userpass" type="password" id="userpass"></td>

                    </tr>

                        <tr>

                        <td colspan="2" align="center">

                        <input type="submit" name="Submit" value="Submit">

                        <input type="reset" name="reset" value="Reset"></td>

                        </tr>
</table>
 </fieldset>

</form>
    </div>
</div>




zzeof;
getFooter();



?>