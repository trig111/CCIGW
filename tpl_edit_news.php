<?php
<<<<<<< HEAD

=======
>>>>>>> 6e6dc0d1f22bb84442e4ea255be007597e1c2ba7
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    
require_once("include/common.php");

if(!is_user_logged_in()){
<<<<<<< HEAD
    redirect('illegal access!', $_SERVER['HTTP_REFERER'], 'Events', 5,false);
=======
    redirect('illegal access!', $_SERVER['HTTP_REFERER'], 'News', 5,false);
>>>>>>> 6e6dc0d1f22bb84442e4ea255be007597e1c2ba7
    exit();
}

if(!clean('get',$keys=array())){
<<<<<<< HEAD
    redirect('illegal access!', $_SERVER['HTTP_REFERER'], 'Events', 5,false);
=======
    redirect('illegal access!', $_SERVER['HTTP_REFERER'], 'News', 5,false);
>>>>>>> 6e6dc0d1f22bb84442e4ea255be007597e1c2ba7
    exit();
}
$error=array();
if(!validate()){
<<<<<<< HEAD
    redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'Events', 5,false);//should redirect to prev page
=======
    redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'News', 5,false);//should redirect to prev page
>>>>>>> 6e6dc0d1f22bb84442e4ea255be007597e1c2ba7
    exit();
}

require_once('dblib/db_news.php');
$de= new Db_news();
$result=$de->show_single_news( $_GET['newsid']);
<<<<<<< HEAD

if(!isArrayOrString($result)){
    redirect($result, $_SERVER['HTTP_REFERER'], 'Events', 5,false);//should redirect to perv page
=======
if(!isArrayOrString($result)){
    redirect($result, $_SERVER['HTTP_REFERER'], 'News', 5,false);//should redirect to perv page
>>>>>>> 6e6dc0d1f22bb84442e4ea255be007597e1c2ba7
    exit();
}

if(empty($result)){
<<<<<<< HEAD
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
     
=======
    redirect('404 NOT FOUND', $_SERVER['HTTP_REFERER'], 'News', 5,false);//should redirect to perv page
    exit();
}

if(!is_legal_access($result['uid']||!is_admin())){
    redirect('illegal access!', $_SERVER['HTTP_REFERER'], 'News', 5,false);
    exit();
}
//require_once("include/demoframe.php");
$css=array('datepicker.css');
$js=array('bootstrap-datepicker.js','bootstrap-datepicker.zh-CN.js','tinymce/tinymce.min.js','tinymce_setting.js','datepicker_category_setting.js');
getHeader("Update News", $css, $js);
output_page_menu();
 
echo <<< zzeof
<form action="server_news_action.php" method="POST">
    
     <h1><input type="text" name="subject" size=80 value="{$result['subject']}"></h1>
>>>>>>> 6e6dc0d1f22bb84442e4ea255be007597e1c2ba7
     <fieldset>
         <legend>Category</legend>
        Select:  <select id="myselect" name="categoryid" onchange="change_content()">
            
                    </select>
<<<<<<< HEAD
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
     
=======
     <input type="text" id="addCategory" value="$categoryname"/><button type="button" onclick="change_category('add');">ADD</button>
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
     
     
zzeof;
//var_dump($result);  
>>>>>>> 6e6dc0d1f22bb84442e4ea255be007597e1c2ba7
getFooter();
 function validate(){
     global $error;
 
<<<<<<< HEAD
     if(!is_numeric($_GET['newsid'])||$_GET['newsid']<1) $error['newsid']="invaild newsid!";
=======
     if(!is_numeric($_GET['eventsid'])||$_GET['eventsid']<1) $error['eventsid']="invaild eventsid!";
>>>>>>> 6e6dc0d1f22bb84442e4ea255be007597e1c2ba7
     if(empty($error))return true;
     else return false;
     
 }
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 6e6dc0d1f22bb84442e4ea255be007597e1c2ba7
