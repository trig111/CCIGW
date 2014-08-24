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
    //print_r($_POST);
    if ( isset($_POST['event_title']) && isset($_POST['event_body']) && isset($_POST['event_id'])
            && isset($_POST['event_uid']))
    {
        $_POST['event_title'] = fix_str($_POST['event_title']); // html injection
        //$_POST['event_body'] = fix_str($_POST['event_body']);
        $_POST['event_id'] = fix_str($_POST['event_id']);
        $_POST['event_uid'] = fix_str($_POST['event_uid']);
        //print_r($_POST);
        $categoryarray=$event_handle->show_category_list();
        $aEvent->categoryid=$categoryarray[0]['categoryid'];
        $aEvent->uid=$_POST['event_uid'];
        $aEvent->eventsid=$_POST['event_id'];
        $aEvent->body=$_POST['event_body'];
        $aEvent->subject=$_POST['event_title'];
        $result= $event_handle->update_events($aEvent);
        header("Location: superuser.php");
        
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
    if ( isset($_POST['event_uid']) && isset($_POST['event_body']) && isset($_POST['event_title']))
    {
        $_POST['this_event_id'] = fix_str($_POST['this_event_id']);
        //$_POST['event_body'] = fix_str($_POST['event_body']);
        $_POST['event_title'] = fix_str($_POST['event_title']);
        $categoryarray=$event_handle->show_category_list();
        $aEvent->subject=$_POST['event_title'];
        $aEvent->readaccess=20;
        $aEvent->body=$_POST['event_body'];
        $aEvent->categoryid=$categoryarray[0]['categoryid'];
        $aEvent->uid=$_POST['event_uid'];
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