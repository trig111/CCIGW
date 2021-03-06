<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    
require_once("include/common.php");

if(!is_user_logged_in()){
    redirect('illegal access!', $_SERVER['HTTP_REFERER'], 'Events', 5,false);
    exit();
}

if(!clean('get',$keys=array())){
    redirect('illegal access!', $_SERVER['HTTP_REFERER'], 'Events', 5,false);
    exit();
}
$error=array();
if(!validate()){
    redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'Events', 5,false);//should redirect to prev page
    exit();
}

require_once('dblib/db_events.php');
$de= new Db_events();
$result=$de->show_single_event( $_GET['eventsid']);

if(!isArrayOrString($result)){
    redirect($result, $_SERVER['HTTP_REFERER'], 'Events', 5,false);//should redirect to perv page
    exit();
}

if(empty($result)){
    redirect('404 NOT FOUND', $_SERVER['HTTP_REFERER'], 'Events', 5,false);//should redirect to perv page
    exit();
}
$categoryname=$de->show_corresponding_category($result['categoryid']);

if(!isArrayOrString($categoryname)){
    redirect($categoryname, $_SERVER['HTTP_REFERER'], 'Events', 5,false);//should redirect to perv page
    exit();
}

if(empty($categoryname)){
    redirect('404 NOT FOUND', $_SERVER['HTTP_REFERER'], 'Events', 5,false);//should redirect to perv page
    exit();
}

if(!is_legal_access($result['uid'])&&!is_admin()){
    
    redirect('illegal access!', $_SERVER['HTTP_REFERER'], 'Events', 5,false);
    exit();
}
//require_once("include/demoframe.php");
$css=array('datepicker.css');
$js=array('bootstrap-datepicker.js','bootstrap-datepicker.zh-CN.js','tinymce/js/tinymce/tinymce.min.js','tinymce_setting.js','datepicker_category_setting.js');
getHeader("Update Event", $css, $js);
output_page_menu();
 
echo <<< zzeof
<div style="width:80%;margin:0 auto;">
<form action="server_event_action.php" method="POST">
    
     <h1><input type="text" name="subject" size=80 value="{$result['subject']}"></h1>
     <fieldset>
         <legend>Category</legend>
        Select:  <select id="myselect" name="categoryid" onchange="change_content()">
            
                    </select>
     <input type="text" id="addCategory" value="{$categoryname['categoryname']}"/><button type="button" onclick="change_category('add');">ADD</button>
     &nbsp;&nbsp;<button type="button" onclick="change_category('delete');">DEL</button>
    </fieldset>
 
     <fieldset>
         <legend>Time Period</legend>
    Start Time:<input size="20" type="text"  name="startime" value="{$result['startime']}" class="form_datetime" readonly><br />
    End Time: <input size="20" type="text" name="endtime" value="{$result['endtime']}" class="form_datetime" readonly>
       
    </fieldset>
  
    Maximum member:<input size="20" type="text" value="{$result['maxmember']}"  name="maxmember" ><br />
      <table > <tr> <td>
   <textarea type="text" name="body"  cols="80" rows="20" > {$result['body']}</textarea>
     </td></tr></table>
     
     <input type="submit" name="modify" value="Modify" />
     <input type="hidden" name="eventsid" value="{$result['eventsid']}"/>
    <input type="hidden" name="uid" value=" {$result['uid']}">
     
     </form>
     </div>
     
zzeof;
//var_dump($result);  
getFooter();
 function validate(){
     global $error;
 
     if(!is_numeric($_GET['eventsid'])||$_GET['eventsid']<1) $error['eventsid']="invaild eventsid!";
     if(empty($error))return true;
     else return false;
     
 }
?>
