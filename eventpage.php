<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    
require_once("include/common.php");

if(!clean('get',$keys=array())){
    redirect('illegal access!', 'index.php', 'home', 5,false);
    exit();
}

$error=array();
$pagesize=8;

if(!validate()){
    redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'home', 5,false);
    exit();
}

require_once('dblib/db_events.php');

$event_handle = new Db_events();
$aEvent = $event_handle->show_single_event($_GET['eventsid']);

if(!isArrayOrString($aEvent)){
    
    redirect($aEvent, $_SERVER['HTTP_REFERER'], 'event', 5,false);//should redirect to perv page
    exit();
}

if(empty($aEvent)){
    redirect('404 NOT FOUND', $_SERVER['HTTP_REFERER'], 'event', 5,false);//should redirect to perv page
    exit();
}
$num  = $event_handle->get_num_of_evtreplys($_GET['eventsid']);

if(!isArrayOrString($num)){
    
    redirect($num, $_SERVER['HTTP_REFERER'], 'Event', 5,false);//should redirect to perv page
    exit();
}

if(empty($num)){
    redirect('404 NOT FOUND', $_SERVER['HTTP_REFERER'], 'event', 5,false);//should redirect to perv page
    exit();
}

$page_key = pagination($num[0],$pagesize,"eventpage.php?eventsid={$_GET['eventsid']}&");

$this_reply_list = $event_handle->show_corresponding_reply_list($_GET['eventsid'],$page_key['offset'],$pagesize);
if(!isArrayOrString($this_reply_list)){
    
    redirect($this_reply_list, $_SERVER['HTTP_REFERER'], 'home', 5,false);//should redirect to perv page
    exit();
}

//if(empty($this_reply_list)){
//    redirect('404 NOT FOUND', $_SERVER['HTTP_REFERER'], 'event', 5,false);//should redirect to perv page
//    exit();
//}
$evtreg_str=array('<button type="button" class="btn btn-info btn-lg" disabled>Register The Event</button>','<button type="button" class="btn btn-warning btn-lg" disabled>Cancel Registeration</button>');
if(is_user_logged_in()){
            $regid=$event_handle->check_is_user_regevt( $_SESSION['uid'],$_GET['eventsid'] );
            
            if(!isArrayOrString($regid)){
                
                redirect($regid, $_SERVER['HTTP_REFERER'], 'home', 5,false);//should redirect to perv page
                exit();
            }

            if(empty($regid)){
                redirect('404 NOT FOUND', $_SERVER['HTTP_REFERER'], 'event', 5,false);//should redirect to perv page
                exit();
            }
            //$evtreg_str=array('<button type="button" class="btn btn-info btn-lg" disabled>Register The Event</button>&nbsp;&nbsp;&nbsp;&nbsp;','<button type="button" class="btn btn-warning btn-lg" disabled>Cancel Registeration</button>');
            if($regid['count']==0){
                $evtreg_str[0]='<button type="button" class="btn btn-info btn-lg"><a href="tpl_new_eventRegistration.php?eventsid='.$_GET['eventsid'].'">Register The Event</a></button>';
            }
            else {
                
                $evtreg_str[0]='<button type="button" class="btn btn-info btn-lg"><a href="tpl_edit_eventRegistration.php?eventsid='.$_GET['eventsid'].'&regid='.$regid['regid'].'">Edit The Registeration</a></button>';
                $evtreg_str[1]='<button type="button" class="btn btn-warning btn-lg"><a href="server_register_event_action.php?action=delete&eventsid='.$_GET['eventsid'].'&uid='.$_SESSION['uid'].'">Cancel Registeration</a></button>&nbsp;&nbsp;&nbsp;&nbsp;';
            }
}
//$evtreg_str=  implode('', $evtreg_str);
//require_once("include/demoframe.php");
$css = array();
$js = array('tinymce/tinymce.min.js','tinymce_setting.js');
getHeader("Event reply list page", $css, $js);
output_page_menu();

//var_dump($aEvent);
$is_editable='';

 if(is_legal_access($aEvent['uid'])){
     $is_editable=' &nbsp;&nbsp; | &nbsp;&nbsp; <a href="'.'tpl_edit_event.php?eventsid='.$aEvent['eventsid'].'">edit</a>';
 }
 
 if(is_admin()){
     $is_editable.=' &nbsp;&nbsp; | &nbsp;&nbsp; <a href="'.'server_event_action.php?eventsid='.$aEvent['eventsid'].'&action=delete">delete</a>';
 }
 

echo<<< zzeof
<div style="width: 70%;margin:0 auto;">
 <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">{$aEvent['subject']}</h3>
  </div>
  <div class="panel-body">
    <fieldset>
         <legend>Time Period</legend>
    Start Time:{$aEvent['startime']} <br />
    End Time: {$aEvent['endtime']} 
       
    </fieldset>
    <br />
    <fieldset>
        <legend> Attendance Allowance</legend>
    Maximum member:{$aEvent['maxmember']}<br />
    </fieldset>
    <br />
    <legend> Body</legend>
    {$aEvent['body']}
  </div>
  <div class="panel-footer">
     by {$aEvent['username']} &nbsp;&nbsp; | &nbsp;&nbsp; created at : {$aEvent['createtime']} &nbsp;&nbsp; | &nbsp;&nbsp; lastedit at : {$aEvent['lastedit']}$is_editable
  </div>
  
</div>

  <div class="row">
  
  <div class="col-md-3 col-md-offset-6">$evtreg_str[0]</div>
  <div class="col-md-3">$evtreg_str[1]</div>
  </div>        

zzeof;
     

if($num[0]>0){
        echo '<br /><br />';
        foreach ($this_reply_list as $aReply) {
            $is_editable='';
            if(is_legal_access($aReply['uid'])||is_admin()){
                $is_editable=' &nbsp;&nbsp; | &nbsp;&nbsp; <a href="'.'tpl_edit_event_reply.php?eventsreplyid='.$aReply['eventsreplyid'].'">edit</a>';
            }

            if(is_admin()){
                $is_editable.=' &nbsp;&nbsp; | &nbsp;&nbsp; <a href="'.'server_reply_event_action.php?eventsreplyid='.$aReply['eventsreplyid'].'&action=delete">delete</a>';
            }
            echo <<<zzeof
      <div class="panel panel-success">
        <div class="panel-body">
            {$aReply['body']}
        </div>
        <div class="panel-footer">
            by {$aReply['username']} &nbsp;&nbsp; | &nbsp;&nbsp; created at : {$aReply['replytime']} &nbsp;&nbsp; | &nbsp;&nbsp; lastedit at : {$aReply['lastedit']}$is_editable
        </div>
      </div>      
     <br />       
zzeof;
        }
}

if(is_user_logged_in()){
    //tpl_post_event_reply
    
    
    echo <<< zzeof

     <form action="server_reply_event_action.php" method="POST" class="form-horizontal">

         <fieldset>
            <legend>
                <strong>RE: </strong>{$aEvent['subject']}
            </legend>

         </fieldset> 
         <br /> 
         <div class="form-group">
            <textarea class="form-control" rows="8" name="body"></textarea>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-0 col-sm-10">
                <button type="submit" class="btn btn-default" name="submit">Submit</button>
            </div>
        </div>
        <input type="hidden" name="eventsid" value="{$_GET["eventsid"]}"/>
        <input type="hidden" name="uid" value=" {$_SESSION['uid']}"/>

         </form>
zzeof;
}
echo '</div>';    
echo $page_key['pagefooter'];

getFooter();

 function validate(){
     global $error;
 
     if(!is_numeric($_GET['eventsid'])||$_GET['eventsid']<1) $error['eventsreplyid']="invaild eventsid!";
     if(!is_numeric($_GET['pg'])||$_GET['pg']<1) $error['pg']='invalid page number!';
     if(empty($error))return true;
     else return false;
     
 }
?>