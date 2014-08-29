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
    redirect(implode("<br />", $error), 'CCIGW/index.php', 'home', 5,false);
    exit();
}

require_once('dblib/db_events.php');

$event_handle = new Db_events();
$aEvent = $event_handle->show_single_event($_GET['eventsid']);

if(!isArrayOrString($aEvent)){
    
    redirect($aEvent, 'index.php', 'home', 5,false);//should redirect to perv page
    exit();
}

if(empty($aEvent)){
    redirect('404 NOT FOUND', 'index.php', 'home', 5,false);//should redirect to perv page
    exit();
}
$num  = $event_handle->get_num_of_evtreplys($_GET['eventsid']);

if(!isArrayOrString($num)){
    
    redirect($num, 'index.php', 'home', 5,false);//should redirect to perv page
    exit();
}

if(empty($num)){
    redirect('404 NOT FOUND', 'index.php', 'home', 5,false);//should redirect to perv page
    exit();
}

$page_key = pagination($num[0],$pagesize,"eventpage.php?eventsid={$_GET['eventsid']}&");

$this_reply_list = $event_handle->show_corresponding_reply_list($_GET['eventsid'],$page_key['offset'],$pagesize);
if(!isArrayOrString($this_reply_list)){
    
    redirect($this_reply_list, 'index.php', 'home', 5,false);//should redirect to perv page
    exit();
}

if($num[0]>0&&empty($this_reply_list)){
    redirect('404 NOT FOUND', 'index.php', 'home', 5,false);//should redirect to perv page
    exit();
}
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
    Start Time:{$aEvent['startime']} ><br />
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

zzeof;
     

if($num[0]>0){
        echo '<br /><br />';
        foreach ($this_reply_list as $aReply) {
            $is_editable='';
            if(is_legal_access($aEvent['uid'])){
                $is_editable=' &nbsp;&nbsp; | &nbsp;&nbsp; <a href="'.'event_manage.php?eventsid='.$aEvent['eventsid'].'&action=edit">edit</a>';
            }

            if(is_admin()){
                $is_editable.=' &nbsp;&nbsp; | &nbsp;&nbsp; <a href="'.'event_manage.php?eventsid='.$aEvent['eventsid'].'&action=del">delete</a>';
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

     <form action="server_event_reply_action.php" method="POST" class="form-horizontal">

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
                <button type="submit" class="btn btn-default" name="Submit">Submit</button>
            </div>
        </div>
        <input type="hidden" name="eventsid" value="{$_GET["eventsid"]}"/>
        <input type="hidden" name="uid" value=" {$_SESSION['uid']}"/>

         </form>
zzeof;
}
    
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