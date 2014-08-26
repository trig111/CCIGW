<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once('dblib/db_events.php');
require_once('dblib/db_user.php');
require_once("include/demoframe.php");
require_once("include/common.php");
require_once('event_action.php');

$css=array('datepicker.css',);
$js=array('bootstrap-datepicker.js','bootstrap-datepicker.zh-CN.js','tinymce/tinymce.min.js','tinymce_setting.js','datepicker_category_setting.js');
//require_once('/form/form_admin.php');
getHeader("Events", $css, $js, '' , 0);

output_page_menu();




 if ( !(isset($_GET["eventsid"]) && is_numeric($_GET["eventsid"]) && count($_GET) === 1 ) ){
     echo'<h1>400 Bad request!</h1>'; // if the GET request is not a valid request
 }
 else{
    
    $event_id = fix_str($_GET["eventsid"]);// for infection
    $event_handle = new Db_events();
    $user_handle = new Db_user();
    $aEvent = $event_handle->show_single_event($event_id);
    
    if ( empty($aEvent)){
        echo'<h1>404 Page not found!</h1>';
    }
    else{
    $categoryname=$event_handle->show_corresponding_category($aEvent['categoryid']);
   
 echo <<< ZZZEOF
   <form action="event_action.php" method="POST">
    
     <h1><input type="text" name="event_title" size=80 value="{$aEvent['subject']}"></h1>
     <fieldset>
         <legend>Category</legend>
        Select:  <select id="myselect" name="categoryid" onchange="change_content()">
            
                    </select>
     <input type="text" id="addCategory" name ="event_category" value="$categoryname"/><button type="button" onclick="change_category('add');">ADD</button>
     &nbsp;&nbsp;<button type="button" onclick="change_category('delete');">DEL</button>
    </fieldset>
 
     <fieldset>
         <legend>Time Period</legend>
    Start Time:<input size="20" type="text"  name="event_starttime" value="{$aEvent['startime']}" class="form_datetime" readonly><br />
    End Time: <input size="20" type="text" name="event_endtime" value="{$aEvent['endtime']}" class="form_datetime" readonly>
       
    </fieldset>
  
    Maximum member:<input size="20" type="text" value="{$aEvent['maxmember']}"  name="event_maxmember" ><br />
      <table > <tr> <td>
   <textarea type="text" name="event_body"  cols="80" rows="20" > {$aEvent['body']}</textarea>
     </td></tr></table>
     
     <input type="submit" name="submit_modify" value="Modify" />
     <input type="hidden" name="event_id" value="$event_id"/>
    <input type="hidden" name="event_uid" value=" {$aEvent['uid']}">
     
     </form>
     
     <div >createtime:{$aEvent['createtime']} lastedit:{$aEvent['lastedit']}</div>
              
ZZZEOF;
     
    }
 }
 getFooter();
 ?>