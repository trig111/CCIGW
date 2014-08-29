<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    
require_once("include/common.php");

if(!is_user_logged_in()||!is_admin()){
    redirect('illegal access!', $_SERVER['HTTP_REFERER'], 'Events', 5,false);
    exit();
}

if(!clean('get',$keys=array())){
    redirect('illegal access!', $_SERVER['HTTP_REFERER'], 'Events', 5,false);
    exit();
}
//$error=array();
//require_once("include/demoframe.php");
$css=array('datepicker.css');
$js=array('bootstrap-datepicker.js','bootstrap-datepicker.zh-CN.js','tinymce/tinymce.min.js','tinymce_setting.js','datepicker_category_setting.js');
getHeader("Post Event", $css, $js);
output_page_menu();
    
echo <<< ZZEOF
    
    <form action="server_event_action.php" method="POST">
    <h1><input type="text" name="subject" size=80 placeholder="Event title"></h1>
     
     <fieldset>
         <legend>Category</legend>
        Select:  <select id="myselect" name="categoryid" onchange="change_content()">
            
                    </select>
     <input type="text" id="addCategory" value=""/><button type="button" onclick="change_category('add');">ADD</button>
     &nbsp;&nbsp;<button type="button" onclick="change_category('delete');">DEL</button>
    </fieldset>
 
     <fieldset>
         <legend>Time Period</legend>
    Start Time:<input size="20" type="text"  name="startime" value="" class="form_datetime" readonly><br />
    End Time: <input size="20" type="text" name="endtime" value="" class="form_datetime" readonly>
       
    </fieldset>
  
    Maximum member:<input size="20" type="text" value="999"  name="maxmember" ><br />
    
     <div ><table > <tr> <td>
     <textarea type="text" name="body"  cols="80" rows="20" >Event content</textarea>
     </td></tr></table></div>

     <input type="submit" name="submit" value="Submit" />
    
     <input type="hidden" name="uid" value=" {$_SESSION['uid']}">
     
     </form>
ZZEOF;
     
getFooter();

?>
<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    
require_once("include/common.php");

if(!is_user_logged_in()||!is_admin()){
    redirect('illegal access!', $_SERVER['HTTP_REFERER'], 'Events', 5,false);
    exit();
}

if(!clean('get',$keys=array())){
    redirect('illegal access!', $_SERVER['HTTP_REFERER'], 'Events', 5,false);
    exit();
}
//$error=array();
//require_once("include/demoframe.php");
$css=array('datepicker.css');
$js=array('bootstrap-datepicker.js','bootstrap-datepicker.zh-CN.js','tinymce/tinymce.min.js','tinymce_setting.js','datepicker_category_setting.js');
getHeader("Post Event", $css, $js);
output_page_menu();
    
echo <<< ZZEOF
    
    <form action="server_event_action.php" method="POST">
    <h1><input type="text" name="subject" size=80 placeholder="Event title"></h1>
     
     <fieldset>
         <legend>Category</legend>
        Select:  <select id="myselect" name="categoryid" onchange="change_content()">
            
                    </select>
     <input type="text" id="addCategory" value=""/><button type="button" onclick="change_category('add');">ADD</button>
     &nbsp;&nbsp;<button type="button" onclick="change_category('delete');">DEL</button>
    </fieldset>
 
     <fieldset>
         <legend>Time Period</legend>
    Start Time:<input size="20" type="text"  name="startime" value="" class="form_datetime" readonly><br />
    End Time: <input size="20" type="text" name="endtime" value="" class="form_datetime" readonly>
       
    </fieldset>
  
    Maximum member:<input size="20" type="text" value="999"  name="maxmember" ><br />
    
     <div ><table > <tr> <td>
     <textarea type="text" name="body"  cols="80" rows="20" >Event content</textarea>
     </td></tr></table></div>

     <input type="submit" name="submit" value="Submit" />
    
     <input type="hidden" name="uid" value=" {$_SESSION['uid']}">
     
     </form>
ZZEOF;
     
getFooter();

?>
