<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    

   
require_once 'include/common.php';
 require_once ('dblib/db_user.php');
require_once("include/demoframe.php");



// check session is null or not
if(!isset($_SESSION['username'])){
    //if session is null then redirect to home
    $url='/index.php';
    redirect('illegal access!', $url,'home');
    exit(0);
}

//else show normal personl info

$username=  fix_str($_SESSION['username']);
//ver_dump($username);
$du= new Db_user();

$result=$du->show_user_info($username);
echo $username;
$css='';

$js=array('group5js/check.js');
getHeader("Home",$css,$js);

output_page_menu();

echo <<<zzeof
<div class="login_and_signup">
<p>your personal infomation</p>
<ul>
<li>uid:&nbsp;&nbsp;{$result['uid']}</li>
<li>accessid:&nbsp;&nbsp;{$result['accessid']}</li>
<li>username:&nbsp;&nbsp;{$result['username']}</li>
<li>email:&nbsp;&nbsp;{$result['email']}</li>
<li>firstname:&nbsp;&nbsp;{$result['firstname']}</li>
<li>lastname:&nbsp;&nbsp;{$result['lastname']}</li>
<li>gender:&nbsp;&nbsp;{$result['gender']}</li>
<li>phonenumber:&nbsp;&nbsp;{$result['phonenumber']}</li>
<li>address:&nbsp;&nbsp;{$result['address']}</li>
<li>created:&nbsp;&nbsp;{$result['created']}</li>
 </div> 
   
</ul>
zzeof;
getFooter();



?>