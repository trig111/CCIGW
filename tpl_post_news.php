<?php

if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    
require_once("include/common.php");

if(!is_user_logged_in()||!is_admin()){//now the news only can be post by admin
    redirect('illegal access!', $_SERVER['HTTP_REFERER'], 'News', 5,false);
    exit();
}

$css=array('datepicker.css');
$js=array('tinymce/tinymce.min.js','tinymce_setting.js','datepicker_category_setting.js');
getHeader("Post News", $css, $js);
output_page_menu();
    
echo <<< ZZEOF
    
    <form action="server_news_action.php" method="POST">
    <h1><input type="text" name="subject" size=80 placeholder="News title"></h1>
     
     <fieldset>
         <legend>Category</legend>
        Select:  <select id="myselect" name="categoryid" onchange="change_content()">
            
                    </select>
     <input type="text" id="addCategory" value=""/><button type="button" onclick="change_category('add');">ADD</button>
     &nbsp;&nbsp;<button type="button" onclick="change_category('delete');">DEL</button>
    </fieldset>
 
     <div ><table > <tr> <td>
     <textarea type="text" name="body"  cols="80" rows="20" >News content</textarea>
     </td></tr></table></div>

     <input type="submit" name="submit" value="Submit" />
    
     <input type="hidden" name="uid" value=" {$_SESSION['uid']}">
     
     </form>
ZZEOF;
     
getFooter();

?>