<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';
require_once 'dblib/db_user.php';
require_once 'dblib/user.class.php';


$url='client_forget_pass_form.php';

if(isset($_POST['username'])&&isset($_POST['email']))
{//in case of all the null inserted to database
    
    
//html injection preventing
$username   = fix_str($_POST['username']);
$email      = fix_str($_POST['email']);





if (!empty($username)&&!empty($email)) {       
    
    
    
    //checking username length
    $pattern="/^\w+$/";
    if(!preg_match($pattern,$username)|| strlen($username)<3 || strlen($username)>15 ){
     
     redirect('invlid username format', $url,'forget password',5,false);
        

        exit();
    }
    

    
//checking email
    $pattern = "/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";

    if (!preg_match($pattern, $email)) {

        

        redirect('invalid email address!', $url,'forget password',5,false);
        
        exit();

    }
   
    
    
    
  }
     //checking potential sql injections
    if(!isDataIllegal()) {
        redirect("illegal inputs", $url,'forget password',5,false);
        
        exit();
    }

    //else checking the uniqueness of username and email
$du= new Db_user();
$result=$du->isMatch_user_name_and_email($username,$email);
      
if(!isBoolOrString($result)){
    echo"$result";
    exit();
}
else if($result===FALSE){
    
    redirect("username and email are not matched, try again!", $url,'forget password',5,false);
        
        exit();   
}
else{
    //else r send to user a email with a reset cite
	
        $result=$du->show_user_info_by_name( $username );
        $pass=$result['userpass'];
	
      $x = sha1($username.'^'.$pass);

       $String = base64_encode($username.",".$x);  



        
       $url='index.php'; 
       redirect(" You will receive a EMAIL soon to reassign a password...", $url,'home',3,true);
        
        

       send_reset_userpass_email($username,$String,$email);
       
    
    
}
}
else{
    
    //any other conditions will redirect to home page
    header('Location:index.php');
}



?>