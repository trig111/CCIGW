<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once("include/common.php");
    
    $uid= isset($_POST['uid']) ? fix_str($_POST['uid']) : fix_str($_GET['uid']);
    if(!is_legal_access($uid)||!is_admin()){
        redirect('illegal access!', 'index.php', 'home', 5,false);
        exit();
    }
    
require_once('dblib/db_events.php');
require_once('dblib/db_user.php');
//require_once("include/demoframe.php");


$error=array();

    $event_handle = new Db_events();
    $user_handle = new Db_user();
    if(isset($_POST['Submit'])){
        if(clean('post',$keys=array())&& validate()){
        
            $result=$user_handle->update_user_info_necessary( $_POST['uid'],$_POST['firstname'],$_POST['lastname'],$_POST['gender'],$_POST['phonenumber'],$_POST['address']);
        
            if(!isBoolOrString($result))$error['sqlerror']=$result;
            else{
                require_once("dblib/eventsreginfo.class.php");
                $newreginfo = new Eventsreginfo(); 
                $newreginfo->remarks=$_POST['remarks'];
                $newreginfo->eventsid=$_POST['eventsid'];
                $newreginfo->uid=$_POST['uid'];
                $newreginfo->numberofpeople=$_POST['numberofpeople'];
                $result=$event_handle->register_event( $newreginfo );
                if(!isBoolOrString($result))$error['sqlerror']=$result;
                else {
                    redirect('your registration now is completed', 'index.php', 'home', 1,true);
                    exit();
                }
            }
        
        }
        // error page ->redirect
        redirect(implode("<br />", $error), 'CCIGW/index.php', 'home', 5,false);
        exit();
    }
   
    
      if(isset($_POST['Modify'])){
        if(clean('post',$keys=array())&& validate()){
        
            $result=$user_handle->update_user_info_necessary( $_POST['uid'],$_POST['firstname'],$_POST['lastname'],$_POST['gender'],$_POST['phonenumber'],$_POST['address']);
        
            if(!isBoolOrString($result))$error['sqlerror']=$result;
            else{
                require_once("dblib/eventsreginfo.class.php");
                $newreginfo = new Eventsreginfo(); 
                $newreginfo->remarks=$_POST['remarks'];
                $newreginfo->eventsid=$_POST['eventsid'];
                $newreginfo->uid=$_POST['uid'];
                $newreginfo->numberofpeople=$_POST['numberofpeople'];
                $result=$event_handle->update_registration( $newreginfo );
                if(!isBoolOrString($result))$error['sqlerror']=$result;
                else {
                    redirect('your registration now is completed', 'index.php', 'home', 1,true);
                    exit();
                }
            }
        
        }
        // error page ->redirect
        redirect(implode("<br />", $error), 'CCIGW/index.php', 'home', 5,false);
        exit();
    }
    
    
    if(isset($_GET['Delete'])&&clean('get',$keys=array())){
        if(!is_numeric(($_POST['eventsid']))){
            $error['eventsid']='invalid eventsid';
        }
         if(!is_numeric($_POST['uid'])){
            $error['uid']='invalid uid';
        }
        if(empty($error)){
            $result=$event_handle->cancel_register($_POST['eventsid'], $_POST['uid']);
            if(!isBoolOrString($result))$error['sqlerror']=$result;
            else {
                if(is_admin()){
                    redirect("the registration now is canceled", $url, $to, 1,true);
                    exit();
                }
                else {
                    redirect("your registration now is canceled", $url, $to,1, true);
                    exit();
                }  
            }
        }
        else{
            redirect(implode("<br />", $error), $url, $to, 5,false);
            exit();
        }
    }
    
    function validate(){
        global $error;
        if(!is_numeric(($_POST['eventsid']))){
            $error['eventsid']='invalid eventsid';
        }
         if(!is_numeric($_POST['uid'])){
            $error['uid']='invalid uid';
        }
            
        if ((utf8_strlen($_POST['firstname']) < 1) || (utf8_strlen($_POST['firstname']) > 32)) {
             $error['firstname'] = 'invalid length of firstname';
        }
        
         if ((utf8_strlen($_POST['lastname']) < 1) || (utf8_strlen($_POST['lastname']) > 32)) {
             $error['lastname'] = 'invalid length of lastname';
        }

//        if ((utf8_strlen($_POST['email']) > 50) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i',$_POST['email'])) {
//                $error['email'] ='invalid format or length of email';
//        }
        if ((utf8_strlen($_POST['address']) >255) || (utf8_strlen($_POST['address']) <5 )) {
             $error['address'] = 'invalid length of address';
        }
        if ($_POST['gender']!='m'&&$_POST['gender']!='f') {
             $error['gender'] = 'invalid gender';
        }
        if (utf8_strlen($_POST['remarks']) >255) {
             $error['remarks'] = 'invalid length of remarks';
        }
        if (utf8_strlen($_POST['phonenumber']) >30 || utf8_strlen($_POST['phonenumber']) <3 || !preg_match('/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/',$_POST['phonenumber'])) {
             $error['phonenumber'] = 'invalid length or format of phonenumber';
        }
        if(!is_numeric($_POST['numberofpeople'])){
            $error['numberofpeole'] = 'invalid format of numberofpeople';
        }
        
        if(!empty($error)) {
            //var_dump($error);
            
            return false;
        }
        else return true;
    }
     

