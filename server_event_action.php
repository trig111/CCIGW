<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';

//$uid= isset($_POST['uid']) ? fix_str($_POST['uid']) : fix_str($_GET['uid']);
    if(!is_admin()){
        redirect('illegal access!', 'index.php', 'home', 5,false);
        exit();
    }
    require_once ("dblib/db_events.php");
    require_once ("dblib/events.class.php");
    $event_handle= new Db_events();
    $aEvent = new Events();


if (isset($_POST['modify'])) {
    if(!clean('post',$keys=array())||!validate()||!is_numeric($_POST['eventsid'])||$_POST['eventsid']<1){
        redirect(implode("<br />", $error), 'CCIGW/index.php', 'home', 5,false);
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
            
            redirect($result, 'index.php', 'home', 5,false);
            exit();
        }
                
        redirect('your (event) post now is updated', 'index.php', 'home', 1,true);//should redirect to prev page
        exit();
        
    }
 
    
// else if (isset($_POST['submit_reply'])) {
//    //print_r($_POST);
//    if (isset($_POST['this_event_id']) && isset($_POST['content'])
//            && isset($_POST['uid_who_reply'])) {
////redirect('Your are currently not logged in ', " ",'Login');
//        // prevent injection
//        $_POST['this_event_id'] = fix_str($_POST['this_event_id']);
//        //$_POST['content'] = fix_str($_POST['content']);
//        $_POST['uid_who_reply'] = fix_str($_POST['uid_who_reply']);
//        
//        
//        $aEvent->Seteventsreply('eventsid', $_POST['this_event_id']);
//        $aEvent->Seteventsreply('body', $_POST['content']);
//        $aEvent->Seteventsreply('uid', $_POST['uid_who_reply']);
//        $result = $event_handle->add_reply($aEvent);
//        if ( !isBoolOrString($result) ){ //  if the user is not logged in or is a invaild user
//            redirect('<h1>Your are currently not logged in</h1> ', "/login.php",'Login');
//            // 
////            echo '<h1>Your are currently not logged in</h1> ';
////            sleep(3);
////            header("Location: login.php");
//        }else{
//            header("Location: eventpage.php?eventsid=" . $_POST['this_event_id']);
//        }
//       // 
//    }  else {
//        echo '400 <h1>Bad request!</h1>';
//    }
elseif( isset($_POST['submit']))
{
    if(!clean('post',$keys=array())||!validate()){
        redirect(implode("<br />", $error), 'CCIGW/index.php', 'home', 5,false);
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
            
            redirect($result, 'index.php', 'home', 5,false);
            exit();
        }
                
        redirect('your (event) post now is submitted', 'index.php', 'home', 1,true);//should redirect to prev page
        exit();
}
elseif(isset($_GET['action'])&&clean('get',$keys=array())&&strcmp($_GET['action'],'delete')==0){
        if(!is_numeric(($_GET['eventsid']))||$_GET['eventsid']<1){
            $error['eventsid']='invalid eventsid';
             redirect(implode("<br />", $error), 'CCIGW/index.php', 'home', 5,false);
            exit();
        }
        
        
        $result=$event_handle->delete_events($_GET['eventsid']);
        if(!isBoolOrString($result)){
            redirect($result, 'index.php', 'home', 5,false);
            exit();
        }
        
        redirect("the (event) post now is deleted",'index.php', 'home', 1,true);
        exit();  
}
else{
    redirect('unforeseen error...', 'index.php', 'home', 5,false);
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
        
         if ((utf8_strlen($_POST['body']) < 3)) {
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
            //var_dump($error);
            
            return false;
        }
        else return true;
    }
?>