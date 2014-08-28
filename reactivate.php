<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';
require_once 'dblib/db_user.php';
require_once("include/demoframe.php");


global $url;
$url='/index.php';

// check get variable is null or not
if(isset($_GET['username'])&&!isset($_GET['reactivate'])&&!isset($_GET['cancel'])){
//if username is set and two submit type of input is null then give user a choice to choose reactivate or cancel
    
$username= fix_str($_GET['username']);
$css='';

$js='';
getHeader("Home",$css,$js);
output_page_menu();
echo <<< zzeof
    
    <form class="login_and_signup",action="logout.php" method="get">
    <p>Do you want to reactivate your account?</p>
    <input type="submit" name="reactivate" value="yes">&nbsp&nbsp
    <input type="submit" name="cancel" value="cancel">
    <input type="hidden" name="key" value="$username">
    </form>
   
zzeof;

getFooter();
unset($_GET['username']);

    
    
}
else if(isset($_GET['reactivate'])){

//if user wants to reactivate then send email with the new code again
    
    if(isset($_GET['key'])){
        $username=fix_str($_GET['key']);
         $du=new Db_user(); 
        $email=$du->get_user_email_by_username($username);
        $pattern = "/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";
        if (!preg_match($pattern, $email)) {
        redirect('error occured reactivation not completed! contact CCIGW TEAM', $url,'home');
        
        exit();

     }
     $identifier=generateCode(4);
           $result=$du->regenerate_activation($username,$identifier);
           if(!isBoolOrString($result)){
                redirect($result, $url,'home');
        
                exit();
           }
      send_activation_email($username,'only you know',$identifier,$email);
       
      redirect('A new EMAIL has been sent to you !', $url,'home');
        
      exit();
        }
  }
else if(isset($_GET['cancel'])){
    //if user don want to reactivate then redirect to home page
    redirect('your account is not activated', $url,'home');
        
      exit();
}
else{
    //else any other conditions will all redirect to home page
    redirect('illegal access!', $url,'home');
        
      exit();
}

?>

