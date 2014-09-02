<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once("include/common.php");
    $uid= isset($_POST['uid']) ? fix_str($_POST['uid']) : fix_str($_GET['uid']);
    
    if(!is_legal_access($uid)){
        //var_dump($uid);
        redirect('illegal access!', 'index.php', 'home', 5,false);
        exit();
    }
    require_once('dblib/db_user.php');
    $user_handle= new Db_user();
    
    if(isset($_POST['edit'])){
        if(!clean('post',$keys=array())|| !validate_profile()){
            if(empty($error))$error['clean']='invalid post request';
            redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'Control Panel', 5,false);
            exit();
        }
        $result=$user_handle->update_user_info_necessary( $_POST['uid'],$_POST['firstname'],$_POST['lastname'],$_POST['gender'],$_POST['phonenumber'],$_POST['address'],$_POST['email']);
        
            if(!isBoolOrString($result)){
                 redirect($result, $_SERVER['HTTP_REFERER'], 'Control Panel', 5,false);
                 exit();
            }
        redirect('your profile now is upodated', $_SERVER['HTTP_REFERER'], 'Control Panel', 1,true);
            exit();
    }
    if(isset($_POST['changepass'])){
        if(!clean('post',$keys=array())|| !validate_changePassowrd()){
            if(empty($error))$error['clean']='invalid post request';
            redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'Control Panel', 5,false);
            exit();
        }
        $result=$user_handle->reset_user_pass($_SESSION['username'],$_POST['newuserpass']);
        
            if(!isBoolOrString($result)){
                 redirect($result, $_SERVER['HTTP_REFERER'], 'Control Panel', 5,false);
                 exit();
            }
        redirect('your password now is upodated', $_SERVER['HTTP_REFERER'], 'Control Panel', 1,true);
            exit();
    }
    else{
        redirect('unforeseen error...', 'index.php','HOME', 5,false);
            exit();
    }
    
    
function validate_profile(){
        global $error, $user_handle ;
         if(!is_numeric($_POST['uid'])||$_POST['uid']<1){
            $error['uid']='invalid uid';
        }
            
        if (!empty($_POST['firstname'])&& (utf8_strlen($_POST['firstname']) > 32)) {
             $error['firstname'] = 'invalid length of firstname';
        }
        
         if (!empty($_POST['lastname'])&& utf8_strlen($_POST['lastname'])> 32) {
             $error['lastname'] = 'invalid length of lastname';
        }

       
        
        if ((utf8_strlen($_POST['email']) > 50) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i',$_POST['email'])) {
                $error['email'] ='invalid format or length of email';
        }
        $result= $user_handle ->check_email_integrity($_POST['uid'],$_POST['email']);
        if(!isBoolOrString($result)){
                 redirect($result, $_SERVER['HTTP_REFERER'], 'Events', 5,false);
                 exit();
        }
        if(!$result){
             $error['email_integrity'] = 'email_integrity failed,try an another email please!';
        }
        if (!empty($_POST['address'])&&(utf8_strlen($_POST['address']) >255 || utf8_strlen($_POST['address']) <5 )) {
             $error['address'] = 'invalid length of address';
        }
        if ($_POST['gender']!='m'&&$_POST['gender']!='f') {
             $error['gender'] = 'invalid gender';
        }
       
        if (!empty($_POST['phonenumber'])&&!preg_match('/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/',$_POST['phonenumber'])) {
             $error['phonenumber'] = 'invalid length or format of phonenumber';
        }
       
        
        if(!empty($error)) {
            //var_dump($error);
            
            return false;
        }
        else return true;
    }
    function validate_changePassowrd(){
        global $error,$user_handle;
         if(!is_numeric($_POST['uid'])||$_POST['uid']<1){
            $error['uid']='invalid uid';
        }
        if (strlen($_POST['userpass']) < 6 || strlen($_POST['userpass']) > 30 ||strlen($_POST['newuserpass']) < 6 || strlen($_POST['newuserpass']) > 30 ) {
            $error['userpass']="password's length should be >=6 and <=30";
        }
        $result= $user_handle ->check_user_account($_SESSION['username'],$_POST['userpass']);
        if(!isBoolOrString($result)){
                 redirect($result, $_SERVER['HTTP_REFERER'], 'control panel', 5,false);
                 exit();
        }
        if(!$result){
             $error['is_match_pass'] = 'old password is not matched!';
        }
       
    
    if(strcmp($_POST['newuserpass'],$_POST['repeat_pass'])!=0){
       $error['repeat_pass']='inconsistent password and repeat password!';
    }
       
        
        if(!empty($error)) {
            //var_dump($error);
            
            return false;
        }
        else return true;
    }