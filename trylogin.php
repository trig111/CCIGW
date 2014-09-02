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



$js=array('group5js/check.js');
getHeader("Home",array(),$js);
output_page_menu();

echo <<<zzeof
<br/><br/><br />
<div style="width:40%;margin:0 auto;">
    <form role="form" name="login" method="post" action="login.php" onSubmit="return doLoginCheck();">
  <div class="form-group">
    <label >UserName</label>
    <input type="username" class="form-control" id="username" placeholder="Enter username" name="username">
  </div>
  <div class="form-group">
    <label ">Password</label>
    <input type="password" class="form-control" id="userpass" placeholder="Password" name="userpass">
  </div>
  
  <button type="submit" class="btn btn-default" name="Submit">Sign In</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="tryregister.php" class="text-center new-account">Create an account </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="tpl_forget_pass_form.php" class="text-center new-account">Forget Password ?</a>
</form>
</div>
zzeof;
getFooter();



?>