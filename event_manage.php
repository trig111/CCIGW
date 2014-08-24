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

//do_page_prequisites();
$css=array('layout.css');
//$js=array('meny.js', 'group5js/check.js');
$js=array('meny.js','tinymce/tinymce.min.js');
//require_once('/form/form_admin.php');
getHeader("Events", $css, $js, '' , 0);

output_page_menu();




 if ( !(isset($_GET["eventsid"]) && is_numeric($_GET["eventsid"]) && count($_GET) === 1 ) ){
     echo'<h1>400 Bad request!</h1>'; // if the GET request is not a valid request
 }else
 {
    $this_event_id = $_GET["eventsid"];
    $event_id = fix_str($this_event_id);// for infection
    $event_handle = new Db_events();
    $user_handle = new Db_user();
    $aEvent = $event_handle->show_single_event($this_event_id);
    if ( empty($aEvent)){
        echo'<h1>404 Page not found!</h1>';
    }else{
     //print_r($aEvent);
      echo '<script type="text/javascript">
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
    echo'<form action="event_action.php" method="POST">';
    
     echo  '<h1>','<input type="text" name="event_title" size=80 value="', $aEvent["subject"]  , '">' , '</h1> ';
     echo '<div > <table > <tr> <td>',
             '<textarea type="text" name="event_body"  cols="80" rows="20" >', $aEvent["body"]  , '</textarea>' ,
     '</td></tr></table></div>';
     
     echo '<input type="submit" name="submit_modify" value="Modify" />';
     echo '<input type="hidden" name="event_id" value="',$this_event_id,'"/>';
     //echo '<input type="hidden" name="event_uid" value="', $user_handle->get_uid_by_name($_SESSION['username'])  , '">';
     echo '<input type="hidden" name="event_uid" value="', 1 , '">';
     echo '</form>';
     
     echo '<div >',
           'createtime:',  $aEvent["createtime"] ,' lastedit:',$aEvent["lastedit"]
     ,'</div>';
     
     
     // begin to showreply 
     
     //print_r( $event_handle->show_corresponding_reply($this_event_id));
    }
 }
 // replay form
getFooter();
?>
