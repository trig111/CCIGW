<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';
require_once 'dblib/db_user.php';
require_once 'dblib/user.class.php';

global $url;

    $url='index.php'; 
    
    //checking null or has value
if(isset($_GET['username'])&&isset($_GET['identifier'])){
    
    //preventing injections
    $username   = fix_str($_GET['username']);
    $identifier    = fix_str($_GET['identifier']);
   
    //serverside checking
    
    $pattern="/^\w+$/";
    if(!preg_match($pattern,$username)|| strlen($username)<3 || strlen($username)>15 ){
     redirect('invlid username format,activation failed', $url,'home',5,false);
        exit();
    }
    
    if(!isDataIllegal()) {
        
         redirect('contains illegal words,activation failed', $url,'home',5,false);
        exit();
    }
    $du= new Db_user();
    $result=$du->check_user_name($username);
    if(!isBoolOrString($result)){
                redirect($result, $url,'home',5,false);
        
        exit();
           }
    else if($result){
        
       redirect('your username can not be found!', $url,'home',5,false);
        exit();
    }
    else{//if all checking passed
        
        $account=new User();
        $account->username=$username;
         $account->identifier=$identifier;
        
         //active_user_account returns 1 2 3 and 4
         //1:already activate
         //2:verification code not correct
         //3:verification code expired
         //4:correct ,and begin to activate
        $result=$du->active_user_account ($account);
        
       
        
       $email=$account->email;
        if($result==0){
             $url='trylogin.php';
            
             redirect('you have already activated!', $url,'login',5,false);
        exit();
        }
        else if($result==1||$result==2){
            if($result==1)echo'verification code is incorrect';
            else if($result==2)echo'your verification code has expired';
           // echo"$email";
            //click to....
//            $identifier=generateCode(4);
//           $result=$du->regenerate_activation($username,$identifier);
//           if(!isBoolOrString($result)){
//                echo $result;
//                exit;
//           }
//            send_activation_email($username,'only you know',$identifier,$email);
            //header('location:index.html');
            $url="reactivate.php?username=$username";
            
            redirect('your verification code is incorrect or has expired !', $url,'reactivation',5,false);
            exit;
        }
        
       else{
           $result=$du->complete_activation ($username);
           if(!isBoolOrString($result)){
           echo $result;
           exit;
           }
            // else  echo'activication completed.';
           
             $url='index.php';
            
             redirect('activication completed!', $url,'home',3,true);
             exit();
       }
    }
    
}

else{// if $_GET[xxx]is null then redirect to home page
    
   redirect('illeagal access!', $url,'home',5,false);
             exit();
}
?>


