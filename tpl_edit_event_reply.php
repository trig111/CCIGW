<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    
require_once("include/common.php");

if(!is_user_logged_in()){
    redirect('illegal access!', 'index.php', 'home', 5,false);
    exit();
}

if(!clean('get',$keys=array())){
    redirect('illegal access!', 'index.php', 'home', 5,false);
    exit();
}

$error=array();

if(!validate()){
    redirect(implode("<br />", $error), 'CCIGW/index.php', 'home', 5,false);
    exit();
}

require_once('dblib/db_events.php');
$de= new Db_events();
$result=$de->show_single_reply( $_GET['eventsreplyid']);

if(!isArrayOrString($result)){
    //var_dump($result);
    redirect($result, 'index.php', 'home', 5,false);//should redirect to perv page
    exit();
}

if(empty($result)){
    
    redirect('404 NOT FOUND', 'index.php', 'home', 5,false);//should redirect to perv page
    exit();
}

if(!is_legal_access($result['uid'])&&!is_admin()){
 
   
    redirect('illegal access!', 'index.php', 'home', 5,false);
    exit();
    
}
$title=$de->show_single_event_name($result['eventsid']);

if(!isArrayOrString($title)){
  
    redirect($title, 'index.php', 'home', 5,false);//should redirect to perv page
    exit();
}

if(empty($title)){
    redirect('404 NOT FOUND', 'index.php', 'home', 5,false);//should redirect to perv page
    exit();
}

//require_once("include/demoframe.php");
$css=array('datepicker.css',);
$js=array('tinymce/js/tinymce/tinymce.min.js','tinymce_setting.js');
getHeader("Edit event reply", $css, $js);
output_page_menu();

   
 echo <<< ZZZEOF
<div style="width:80%;margin:0 auto;">
   <form action="server_reply_event_action.php" method="POST" class="form-horizontal" role="form">
    
     <fieldset>
        <legend>
            {$title['subject']}
        </legend>
        <div class="form-group">
            <label class="col-sm-2 control-label">Post at:</label>
            <div class="col-sm-3">
                <input type="text" name="replytime" class="form-control" value="{$result['replytime']}" readonly>
            </div>
        </div>
            
        <div class="form-group">
            <label class="col-sm-2 control-label">Lastedit:</label>
            <div class="col-sm-3">
                <input type="text" name="lastedit" class="form-control" value="{$result['lastedit']}" readonly>
            </div>
        </div>
     </fieldset> 
     <br/>
     <div class="form-group">
        <textarea class="form-control" rows="20" name="body">{$result['body']}</textarea>
    </div>
    <div class="form-group">
        <div class="col-sm-8">
            <button type="submit" class="btn btn-default" name="modify">Modify</button>
        </div>
    </div>
    <input type="hidden" name="eventsid" value="{$result['eventsid']}"/>
    <input type="hidden" name="eventsreplyid" value="{$_GET['eventsreplyid']}"/>
    <input type="hidden" name="uid" value=" {$result['uid']}">
     
     </form>
   </div>  
ZZZEOF;
    
 getFooter();
 
 function validate(){
     global $error;
 
     if(!is_numeric($_GET['eventsreplyid'])) $error['eventsreplyid']="invaild eventsreplyid!";
     //if(strcmp($_GET['action'],'modify')!=0) $error['action']='invalid action!';
     if(empty($error))return true;
     else return false;
     
 }
 ?>

