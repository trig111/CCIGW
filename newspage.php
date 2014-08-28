
<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once('dblib/db_news.php');
require_once('dblib/db_user.php');
require_once("include/demoframe.php");
require_once("include/common.php");

//do_page_prequisites();
$css='';
//$js=array('meny.js', 'group5js/check.js');
$js=array('tinymce/tinymce.min.js');
//require_once('/form/form_admin.php');
getHeader("Events", $css, $js);

output_page_menu();




 if ( !(isset($_GET["newsid"]) &&  is_numeric($_GET["newsid"])) ){
     echo'<h1> 400 Bad request</h1>';
 }else
 {
    $this_news_id = fix_str($_GET["newsid"]);
    $news_id = fix_str($this_news_id);// for infection
    $news_handle = new Db_news();
    $user_handle = new Db_user();
    $aNews = $news_handle->show_single_news($this_news_id);
    if(empty($aNews)){
        echo'<h1> 404 Page not found</h1>';
    }else{
        //print_r($aEvent);
     echo  '<h1>', $aNews["subject"] , '</h1> ';
     echo '<div id="eventBox"> <table > <tr> <td>',
             $aNews["body"]
     ,'</td></tr></table></div>';
     
     echo '<div >',
           'createtime:',  $aNews["createtime"] ,' lastedit:',$aNews["lastedit"]
     ,'</div>';
     
     
     // begin to showreply 
     
     //print_r( $event_handle->show_corresponding_reply($this_event_id));
    }
     
     
 }
 
 getFooter();
 ?>