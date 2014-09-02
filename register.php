<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';
require_once 'dblib/db_user.php';
require_once 'dblib/user.class.php';




if(isset($_POST['username'])&&isset($_POST['userpass'])&&isset($_POST['repeat_pass'])
    &&isset($_POST['email'])&&isset($_POST['gender'])&&isset($_POST['firstname'])&&isset($_POST['lastname'])
    &&isset($_POST['phonenumber'])&&isset($_POST['address']))
{//in case of all the null inserted to database
    
    
//html injection preventing
$username   = fix_str($_POST['username']);
$userpass    = fix_str($_POST['userpass']);
$repeat_pass = fix_str($_POST['repeat_pass']);
$email      = fix_str($_POST['email']);
$gender     = fix_str($_POST['gender']);	
$firstname= fix_str($_POST['firstname']);
$lastname= fix_str($_POST['lastname']);
$phonenumber= fix_str($_POST['phonenumber']);
$address= fix_str($_POST['address']);

global $url;
$url='tryregister.php';

if (!empty($username)) {       
    //checking all the required fileds are not empty
    if (empty($username)|| empty($email)||empty($gender)

            || empty($userpass) || $repeat_pass != $userpass) {
        
        redirect('missing one or more fileds', $url,'register',5,false);

        exit();
       

        

    }
    
    
    //checking username length
    $pattern="/^\w+$/";
    if(!preg_match($pattern,$username)|| strlen($username)<3 || strlen($username)>15 ){
     
     redirect('invalid username format, $url','register',5,false);
        

        exit();
    }
    //checking password's length
    if (strlen($userpass) < 6 || strlen($userpass) > 30) {

      redirect("password's length should be >=6 and <=30", $url,'register',5,false);
        

        exit();

    }
    if(strcmp($userpass, $repeat_pass)!=0){
        redirect("inconsistent password and repeat password!", $url,'register',5,false);
        

        exit();
    }
    
//checking email
    $pattern = "/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/";

    if (!preg_match($pattern, $email)) {

        

        redirect('invalid email address!', $url,'register',5,false);
        
        exit();

    }
   // checking phonenumber format
    $pattern = "/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/";
                
     if($phonenumber!==''){
        
        if (!preg_match($pattern,$phonenumber) ) {
        
        redirect('invalid phonenumber!', $url,'register',5,false);
        
        exit();
    }
     }
    
     $pattern = "/^[a-z]+$/i";
    if($lastname!==''){
        //checking lastname format
        if (!preg_match($pattern,$lastname) ) {
        
       redirect('invalid lastname!', $url,'register',5,false);
        
        exit();
    }
        
    }
    
     if($firstname!==''){
        //checking firstname format
        if (!preg_match($pattern,$firstname) ) {
        
        redirect('invalid firstname!', $url,'register',5,false);
        
        exit();
    }
        
    }
    //checking address length
    if(strlen($address)>=255){
        redirect("address'length should be <255", $url,'register',5,false);
        
        exit();    
    }
    
     }
     //checking potential sql injections
    if(!isDataIllegal()) {
        redirect("illegal inputs", $url,'register',false);
        
        exit();
    }

    //else checking the uniqueness of username and email
$du= new Db_user();
$result=$du->check_user_name_and_email($username,$email);
      
if(!isBoolOrString($result)){
    echo"$result";
    exit();
}
else if($result===FALSE){
    
    redirect("username or email already exist, try again!", $url,'register',5,false);
        
        exit();   
}
else{
    //else regiser user info to database and send to user a email with a access code
	$newuser = new User();
        
        
	$newuser->username=$username;
	$newuser->accessid=1;
	$newuser->userpass=$userpass;
	//$newuser->created='now()';
        $newuser->email=$email;
        $newuser->gender=$gender;	
        $newuser->firstname=$firstname;
        $newuser->lastname=$lastname;
        $newuser->phonenumber=$phonenumber;
        $newuser->address=$address;
        $newuser->status=0;
//        $newuser->lastlogin,
        $verifycode=generateCode(4);
        $newuser->identifier= $verifycode;
      //$newuser->expiry_time='now()+interval 1 day';
        

	$result=$du->add_new_user($newuser);
//        $lastlogin=date("Y-m-d H:i:s");
        if(!isBoolOrString($result)){
              redirect($result, $url,'register',5,false);
        
        exit();
        }

        
       $url='index.php'; 
       redirect("registration completed! You need to activate your account via EMAIL...", $url,'home',3,true);
        
        

       send_activation_email($username,$userpass,$verifycode,$email);
       
    
    
}
}
else{
    
    //any other conditions will redirect to home page
    header('Location:index.php');
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>