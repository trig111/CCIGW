<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';
require_once("include/demoframe.php");
//do_page_prerequisites();
global $url;
    $url='/index.php';
    
if(isset($_SESSION['username'])&&!isset($_GET['logout'])&&!isset($_GET['cancel'])){
    //if user is still logged in and logout variable is null as well as cancel
    
    //preventing html injection
    $username= fix_str($_SESSION['username']);
    $lastlogin=  fix_str($_SESSION['lastlogin']);
    
   


getHeader("Home",'','');
output_page_menu();
    
    //give user a option to decide whether to logged out or cancel

    echo <<< zzeof
    <p>Dear $username,you have already logged in and the last time you logged in:@ $lastlogin</p>
    <form class="login_and_signup",action="logout.php" method="get">
    <input type="submit" name="logout" value="logout">&nbsp&nbsp
    <input type="submit" name="cancel" value="cancel">
    </form>
   
zzeof;

getFooter();
    exit();
}
else if(isset($_GET['logout'])) {
    //if user is logout then redirect to home page
        unset($_SESSION['username']);
        unset($_SESSION['lastlogin']);
        unset($_SESSION['accessid']);
        unset($_SESSION['uid']);
        redirect('now you are logged out!',$url,'home');

        exit();
        
    }
 else if(isset($_GET['cancel'])){
     //if user is not logged out, also redirect to home page
     redirect('you are not logged out!', $url,'home');

        exit();
     
 }
 else{//if session[username] is null
     redirect('illegal access!', $url,'home');
        exit();
     
 }
    
 ?>
		
               

