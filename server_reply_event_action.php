<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';

$uid= isset($_POST['uid']) ? fix_str($_POST['uid']) : fix_str($_GET['uid']);
   if(!is_legal_access($uid)&&!is_admin()){
    redirect('illegal access!', 'index.php', 'home', 5,false);
    exit();
}
    require_once ("dblib/db_events.php");
    require_once ("dblib/events.class.php");
    $event_handle= new Db_events();
    $aEvent = new Events();


if (isset($_POST['modify'])) {

    if(!clean('post',$keys=array())||!validate()||!is_numeric($_POST['eventsreplyid'])||$_POST['eventsreplyid']<1){
        if(empty($error))$error['eventsreplyid_or_clean']='invalid eventsreplyid or post request';
//        var_dump($_POST);
        redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'Events', 5,false);
        exit();
    }
            $aEvent->Seteventsreply('eventsid',$_POST['eventsid']);
            $aEvent->Seteventsreply('body',$_POST['body']);
            $aEvent->Seteventsreply('uid',$_POST['uid']);
            $aEvent->Seteventsreply('replytime',$_POST['replytime']);
            $aEvent->Seteventsreply('eventsreplyid',$_POST['eventsreplyid']);
            
        $result=$event_handle->update_reply($aEvent);
        if(!isBoolOrString($result)){
            
            redirect($result, $_SERVER['HTTP_REFERER'], 'Events', 5,false);
            exit();
        }
                
        redirect('your reply now is updated', 'events.php?pg=1', 'Events', 1,true);//should redirect to prev page
        exit();
        
    }

elseif( isset($_POST['submit']))
{
    if(!clean('post',$keys=array())||!validate()){
        if(empty($error))$error['clean']='invalid post request';
        redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'Events', 5,false);
        exit();
    }
       $aEvent->Seteventsreply('eventsid',$_POST['eventsid']);
            $aEvent->Seteventsreply('body',$_POST['body']);
            $aEvent->Seteventsreply('uid',$_POST['uid']);
          
            
        $result=$event_handle->add_reply($aEvent);
        if(!isBoolOrString($result)){
            
            redirect($result, $_SERVER['HTTP_REFERER'], 'Events', 5,false);
            exit();
        }
                
        redirect('your reply now is updated', 'events.php?pg=1', 'Events', 1,true);//should redirect to prev page
        exit();
        
}
elseif(isset($_GET['action'])&&clean('get',$keys=array())&&strcmp($_GET['action'],'delete')==0){
        if(!is_numeric(($_GET['eventsreplyid']))||$_GET['eventsreplyid']<1){
            $error['eventsreplyid']='invalid eventsreplyid';
             redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'Events', 5,false);
            exit();
        }
        
        
        $result=$event_handle->delete_reply($_GET['eventsreplyid']);
        if(!isBoolOrString($result)){
            redirect($result, $_SERVER['HTTP_REFERER'], 'Events', 5,false);
            exit();
        }
        
        redirect("the reply now is deleted",'events.php?pg=1', 'Events', 1,true);
        exit();  
}
else{
    redirect('unforeseen error...', $_SERVER['HTTP_REFERER'], 'Events', 5,false);
    exit();
}

function validate(){
        global $error;
        if(!is_numeric(($_POST['eventsid']))||$_POST['eventsid']<1){
            $error['eventsid']='invalid eventsid';
        }
         if(!is_numeric($_POST['uid'])||$_POST['uid']<1){
            $error['uid']='invalid uid';
        }
        
        
         if ((utf8_strlen($_POST['body']) < 11)) {
             $error['body'] = 'invalid length of body';
         }

        if ((strlen($_POST['replytime']) >20)) {
             $error['startime'] = 'invalid length of startime';
        }
        if ((strlen($_POST['lastedit']) >20)) {
             $error['endtime'] = 'invalid length of startime';
        }
       
        
        if(!empty($error)) {
            
            
            return false;
        }
        else return true;
    }
?>

