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

require_once('dblib/db_news.php');
$de= new Db_news();
$result=$de->show_single_news( $_GET['newsid']);

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

$css=array('datepicker.css');
$js=array('tinymce/tinymce.min.js','tinymce_setting.js','datepicker_category_setting.js');
getHeader("Post News", $css, $js);
output_page_menu();
    
echo <<< ZZEOF
    
    <form action="server_news_action.php" method="POST">
    <h1><input type="text" name="subject" size=80 value="{$result['subject']}"></h1>
     
     <fieldset>
         <legend>Category</legend>
        Select:  <select id="myselect" name="categoryid" onchange="change_content()">
            
                    </select>
     <input type="text" id="addCategory" value="{$categoryname['categoryname']}"/><button type="button" onclick="change_category('add');">ADD</button>
     &nbsp;&nbsp;<button type="button" onclick="change_category('delete');">DEL</button>
    </fieldset>
 
     <div ><table > <tr> <td>
     <textarea type="text" name="body"  cols="80" rows="20" >{$result['body']}</textarea>
     </td></tr></table></div>

     <input type="submit" name="modify" value="Modify" />
     <input type="hidden" name="newsid" value="{$result['newsid']}"/>
    
     <input type="hidden" name="uid" value=" {$_SESSION['uid']}">
     
     </form>
ZZEOF;
     
getFooter();
 function validate(){
     global $error;
 
     if(!is_numeric($_GET['newsid'])||$_GET['newsid']<1) $error['newsid']="invaild newsid!";
     if(empty($error))return true;
     else return false;
     
 }
?>