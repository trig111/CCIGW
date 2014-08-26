<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';
require_once ("dblib/db_events.php");
require_once ("dblib/events.class.php");
$event_handle = new Db_events();
$aEvent = new Events();


if (isset($_POST['submit_modify'])) {
   
    if ( isset($_POST['event_uid']) &&isset($_POST['event_title']) && isset($_POST['event_body']) && isset($_POST['event_id'])&& isset($_POST['categoryid']))
            
    {
        $event_uid= fix_str($_POST['event_uid']);
      $event_id= fix_str($_POST['event_id']);
        $event_body = fix_str($_POST['event_body']);
        $event_title = fix_str($_POST['event_title']);
         $categoryid = fix_str($_POST['categoryid']);
         $event_starttime=fix_str($_POST['event_starttime']);
         $event_endtime=fix_str($_POST['event_endtime']);
         $event_maxmember=fix_str($_POST['event_maxmember']);
        $aEvent->eventsid=$event_id;
        $aEvent->subject=$event_title;
        $aEvent->readaccess=0;
        $aEvent->body=$event_body;
        $aEvent->categoryid=$categoryid;
        $aEvent->uid=$event_uid;
        $aEvent->maxmember=$event_maxmember;
        if(!empty($event_starttime))$aEvent->startime=$event_starttime;
        if(!empty($event_endtime))$aEvent->endtime=$event_endtime;
        if(!empty($event_maxmember))$aEvent->maxmember=$event_maxmember;
        $result=$event_handle->update_events($aEvent);
        
        header("Location: superuser.php");
        
        
        //print_r($_POST);
     
        
    }
 
    
} elseif (isset($_POST['submit_reply'])) {
    //print_r($_POST);
    if (isset($_POST['this_event_id']) && isset($_POST['content'])
            && isset($_POST['uid_who_reply'])) {
//redirect('Your are currently not logged in ', " ",'Login');
        // prevent injection
        $_POST['this_event_id'] = fix_str($_POST['this_event_id']);
        //$_POST['content'] = fix_str($_POST['content']);
        $_POST['uid_who_reply'] = fix_str($_POST['uid_who_reply']);
        
        
        $aEvent->Seteventsreply('eventsid', $_POST['this_event_id']);
        $aEvent->Seteventsreply('body', $_POST['content']);
        $aEvent->Seteventsreply('uid', $_POST['uid_who_reply']);
        $result = $event_handle->add_reply($aEvent);
        if ( !isBoolOrString($result) ){ //  if the user is not logged in or is a invaild user
            redirect('<h1>Your are currently not logged in</h1> ', "/login.php",'Login');
            // 
//            echo '<h1>Your are currently not logged in</h1> ';
//            sleep(3);
//            header("Location: login.php");
        }else{
            header("Location: eventpage.php?eventsid=" . $_POST['this_event_id']);
        }
       // 
    }  else {
        echo '400 <h1>Bad request!</h1>';
    }
} elseif( isset($_POST['submit_new_event']))
{
    if ( isset($_POST['event_uid']) && isset($_POST['event_body']) && isset($_POST['event_title'])&& isset($_POST['categoryid']))
    {
        $event_uid = fix_str($_POST['event_uid']);
        $event_body = fix_str($_POST['event_body']);
        $event_title = fix_str($_POST['event_title']);
         $categoryid = fix_str($_POST['categoryid']);
         $event_starttime=fix_str($_POST['event_starttime']);
         $event_endtime=fix_str($_POST['event_endtime']);
         $event_maxmember=fix_str($_POST['event_maxmember']);
        //$categoryarray=$event_handle->show_category_list();
        $aEvent->subject=$event_title;
        $aEvent->readaccess=0;
        $aEvent->body=$event_body;
        $aEvent->categoryid=$categoryid;
        $aEvent->uid=$event_uid;
        $aEvent->maxmember=$event_maxmember;
        if(!empty($event_starttime))$aEvent->startime=$event_starttime;
        if(!empty($event_endtime))$aEvent->endtime=$event_endtime;
        if(!empty($event_maxmember))$aEvent->maxmember=$event_maxmember;
        $result=$event_handle->post_events($aEvent);
        header("Location: superuser.php");
    }
    
}elseif (isset ($_POST['delete_event']))
{
    if ( isset($_POST['checkbox_events']))
    {
        $_POST['checkbox_events'] = fix_str($_POST['checkbox_events']);
        foreach ($_POST['checkbox_events'] as $event_id_delete ){
            $aEvent->eventsid=$event_id_delete;
            $event_handle->delete_events($aEvent);
        }
        header("Location: superuser.php");
    }
}
?>