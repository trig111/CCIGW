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

echo '<link href="css/login.css" rel="stylesheet">';

$js=array('group5js/check.js');
getHeader("Home",'',$js,'',0);
output_page_menu();
/*echo <<< zzeof
<h1>Login</h1>
<div class="responsive-container">
    <div class="dummy"></div>

    <div class="form-container">
        <div class="centerer"></div>
        
        <form class="login_and_signup" name="login" method="post" action="login.php" onSubmit="return doLoginCheck();">

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
*/




echo <<<zzeof
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Login</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                <form class="form-signin" name="login" method="post" action="login.php" onSubmit="return doLoginCheck();">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autofocus>
                <input type="password" class="form-control" name="userpass" id="userpass" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="Submit" value="Submit">
                    Sign in</button>
                <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label>
                <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                </form>
            </div>
            <a href="tryregister.php" class="text-center new-account">Create an account </a>
        </div>
    </div>
</div>
zzeof;
getFooter();



?>