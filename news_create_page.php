<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once('dblib/db_events.php');
require_once 'dblib/db_news.php';
require_once('dblib/db_user.php');
require_once("include/demoframe.php");
require_once("include/common.php");
require_once('event_action.php');

//do_page_prequisites();
$css='';
//$js=array('meny.js', 'group5js/check.js');
$js=array('tinymce/tinymce.min.js');
//require_once('/form/form_admin.php');
getHeader("Events", $css, $js);

output_page_menu();



    
    
    $event_handle = new Db_events();
    $user_handle = new Db_user();
    
     //print_r($aEvent);
            echo '
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script> ';
            
    echo'<form action="news_action.php" method="POST">';
    
     echo  '<h1>','<input type="text" name="news_title" size=80 value="News title">' , '</h1> ';
     echo '<div > <table > <tr> <td>',
             '<textarea type="text"  cols="80" rows="20"  name="news_body" >News content</textarea>' ,
     '</td></tr></table></div>';
     
     echo '<input type="submit" name="submit_new_news" value="Submit" />';
    
     //echo '<input type="hidden" name="event_uid" value="', $user_handle->get_uid_by_name($_SESSION['username'])  , '">';
     echo '<input type="hidden" name="news_uid" value="', 1 , '">';
     echo '</form>';
     
     
     
     
     // begin to showreply 
     
     //print_r( $event_handle->show_corresponding_reply($this_event_id));

 
 // replay form
getFooter();
?>
