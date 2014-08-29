<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';

$uid= isset($_POST['uid']) ? fix_str($_POST['uid']) : fix_str($_GET['uid']);
    if(is_legal_access($uid)||!is_admin()){
        redirect('illegal access!', 'index.php', 'Home', 5,false);
        exit();
    }
    require_once ("dblib/db_events.php");
    require_once ("dblib/events.class.php");
    $event_handle= new Db_events();
    $aEvent = new Events();


if (isset($_POST['modify'])) {

    if(!clean('post',$keys=array())||!validate()||!is_numeric($_POST['eventsid'])||$_POST['eventsid']<1){
        if(empty($error))$error['eventsid_or_clean']='invalid eventsid or post request';
        redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'Events', 5,false);
        exit();
    }
        $aEvent->eventsid=$_POST['eventsid'];
        $aEvent->subject=$_POST['subject'];
        $aEvent->readaccess=0;
        $aEvent->body=$_POST['body'];
        $aEvent->categoryid=$_POST['categoryid'];
        $aEvent->uid=$_POST['uid'];
        $aEvent->maxmember=$_POST['maxmember'];
        $aEvent->startime=$_POST['startime'];
        $aEvent->endtime=$_POST['endtime'];
        $aEvent->maxmember=$_POST['maxmember'];
        $result=$event_handle->update_events($aEvent);
        if(!isBoolOrString($result)){
            
            redirect($result, $_SERVER['HTTP_REFERER'], 'Events', 5,false);
            exit();
        }
                
        redirect('your (event) post now is updated', 'events.php?pg=1', 'Events', 1,true);//should redirect to prev page
        exit();
        
    }

elseif( isset($_POST['submit']))
{
    if(!clean('post',$keys=array())||!validate()){
        if(empty($error))$error['lean']='invalid post request';
        redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'Events', 5,false);
        exit();
    }
        $aEvent->subject=$_POST['subject'];
        $aEvent->readaccess=0;
        $aEvent->body=$_POST['body'];
        $aEvent->categoryid=$_POST['categoryid'];
        $aEvent->uid=$_POST['uid'];
        $aEvent->maxmember=$_POST['maxmember'];
        $aEvent->startime=$_POST['startime'];
        $aEvent->endtime=$_POST['endtime'];
        $aEvent->maxmember=$_POST['maxmember'];
        $result=$event_handle->post_events($aEvent);
        if(!isBoolOrString($result)){
            
            redirect($result, $_SERVER['HTTP_REFERER'], 'Events', 5,false);
            exit();
        }
                
        redirect('your (event) post now is submitted', $_SERVER['HTTP_REFERER'], 'Events', 1,true);//should redirect to prev page
        exit();
}
elseif(isset($_GET['action'])&&clean('get',$keys=array())&&strcmp($_GET['action'],'delete')==0){
        if(!is_numeric(($_GET['eventsid']))||$_GET['eventsid']<1){
            $error['eventsid']='invalid eventsid';
             redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'Events', 5,false);
            exit();
        }
        
        
        $result=$event_handle->delete_events($_GET['eventsid']);
        if(!isBoolOrString($result)){
            redirect($result, $_SERVER['HTTP_REFERER'], 'Events', 5,false);
            exit();
        }
        
        redirect("the (event) post now is deleted",'events.php?pg=1', 'Events', 1,true);
        exit();  
}
else{
    redirect('unforeseen error...', $_SERVER['HTTP_REFERER'], 'Events', 5,false);
    exit();
}

function validate(){
        global $error;
//        if(!is_numeric(($_POST['eventsid']))||$_POST['eventsid']<1){
//            $error['eventsid']='invalid eventsid';
//        }
         if(!is_numeric($_POST['uid'])||$_POST['uid']<1){
            $error['uid']='invalid uid';
        }
          if(!is_numeric($_POST['maxmember'])||$_POST['maxmember']<0){
            $error['maxmember']='invalid maxmember';
        }  
        
         if ((utf8_strlen($_POST['body']) < 4)) {
             $error['body'] = 'invalid length of body';
        }
          if(!is_numeric($_POST['categoryid'])||$_POST['categoryid']<1){
            $error['categoryid']='invalid categoryid';
        } 

        if ((strlen($_POST['startime']) >20)) {
             $error['startime'] = 'invalid length of startime';
        }
        if ((strlen($_POST['endtime']) >20)) {
             $error['endtime'] = 'invalid length of startime';
        }
        if (utf8_strlen($_POST['subject']) >25||utf8_strlen($_POST['subject']) <3) {
             $error['subject'] = 'invalid length of subject';
        }
        
        if(!empty($error)) {
            
            
            return false;
        }
        else return true;
    }
?>