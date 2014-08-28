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


$css=array('datepicker.css');
$js=array('bootstrap-datepicker.js','bootstrap-datepicker.zh-CN.js','tinymce/tinymce.min.js','tinymce_setting.js','datepicker_category_setting.js');
//require_once('/form/form_admin.php');
getHeader("Events", $css, $js);

output_page_menu();
    
    $event_handle = new Db_events();
    $user_handle = new Db_user();
    
     //print_r($aEvent);
echo <<< ZZEOF
    
    <form action="event_action.php" method="POST">
    <h1><input type="text" name="event_title" size=80 value="Event title"></h1>
     
     <fieldset>
         <legend>Category</legend>
        Select:  <select id="myselect" name="categoryid" onchange="change_content()">
            
                    </select>
     <input type="text" id="addCategory" name ="event_category" value=""/><button type="button" onclick="change_category('add');">ADD</button>
     &nbsp;&nbsp;<button type="button" onclick="change_category('delete');">DEL</button>
    </fieldset>
 
     <fieldset>
         <legend>Time Period</legend>
    Start Time:<input size="20" type="text"  name="event_starttime" value="" class="form_datetime" readonly><br />
    End Time: <input size="20" type="text" name="event_endtime" value="" class="form_datetime" readonly>
       
    </fieldset>
  
    Maximum member:<input size="20" type="text" value="999"  name="event_maxmember" ><br />
    
     <div ><table > <tr> <td>
     <textarea type="text" name="event_body"  cols="80" rows="20" >Event content</textarea>
     </td></tr></table></div>

     <input type="submit" name="submit_new_event" value="Submit" />
    
     <input type="hidden" name="event_uid" value=" {$user_handle->get_uid_by_name($_SESSION['username'])}">
     
     </form>
ZZEOF;
     
     
//print_r( $event_handle->show_corresponding_reply($this_event_id));

 
 // replay form
getFooter();
?>
