<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

require_once 'include/common.php';
require_once 'dblib/db_user.php';

if(!isset($_SESSION['username'])){// if not logged in

if (!(array_key_exists('username', $_POST)||!array_key_exists('userpass', $_POST)))
{
//if the inputs are null redirect to login page
  header('location:trylogin.php');
  exit(0);
}


//preventing html injection
$username = fix_str($_POST['username']);
$userpass = fix_str($_POST['userpass']);
global $url;

$url='trylogin.php';

if (!empty($username)) {       
    //checking all the required fileds are not empty
    if (empty($username)||empty($userpass)) {
        
        redirect('missing one or more fileds', $url,'login',5,false);

        exit();

    }
    
    //checkng username format and length
    $pattern="/^\w+$/";
    if(!preg_match($pattern,$username)|| strlen($username)<3 || strlen($username)>15 ){
        
         redirect('invalid username input', $url,'login',5,false);
     
     exit();
    }
    // checking password's length
    if (strlen($userpass) < 6 || strlen($userpass) > 30) {
         
         redirect("password's length should be >=6 and <=30", $url,'login',5,false);
        

        exit();

    }
    //checking any potential sql injections
    if(!isDataIllegal()) {
        
         redirect("illegal inputs", $url,'login',5,false);
        
        exit();
    }
   
    $du= new Db_user();
    $result=$du->check_user_account( $username,$userpass);
      
if(!isBoolOrString($result)){
    //check any database error occured
         redirect($result, $url,'login',5,false);
        
        exit();
}
else if($result===FALSE){
    //if no record is matched then redirect to login page
    
         redirect('username or password is not correct, try again!', $url,'login',5,false);
        
        exit();
}
$result=$du->check_user_status($username);

if(!isBoolOrString($result)){
    echo"$result";
    exit();
}
else if($result===FALSE){
   //checking if user is not activated
    $url="reactivate.php?username=$username";
            
            redirect('your account is not activated!!', $url,'reactivation',1,true);
            exit;
    //send_activation_email($username,$userpass,$verifycode,$email);
    exit();
}

else{
    //else update users info and log him of her in
    
    $lastlogin=date("Y-m-d H:i:s");
   $result=$du->update_user_info_when_login($username);//need to check more
   if(!isBoolOrString($result)){
        $url='trylogin.php';
         redirect($result, $url,'login',5,false);
        
        exit();
    }
   $result=$du->show_single_user_access_and_uid($username);
   
   $accessid=$result['accessid'];
   $uid=$result['uid'];
   
   
     $_SESSION['username']=$username;
     $_SESSION['lastlogin']=$lastlogin;
     $_SESSION['accessid']=$accessid;
     $_SESSION['uid']=$uid;
    
       $url='index.php';
         redirect('you have logged in successfully','index.php','home',1,true);
        
        exit();
    
}

    
}
else{
     
     
   $url='index.php';
    redirect('illegal access', $url,'home',5,false);
    exit();
    }
}

else{
    
    // if user is already loged in and wants to log in again then he/she has to log out first
    // redirect to logout page 
    //echo"Dear $username,you have already logged in and the last time you logged in:@ $lastlogin\n";
    header('Location:logout.php');
    
    exit();
}

?>
    



