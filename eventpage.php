
<?php

if (!isset($_SESSION)) {
    session_start();
}
require_once('dblib/db_events.php');
require_once('dblib/db_user.php');
require_once("include/demoframe.php");
require_once("include/common.php");
require_once('event_action.php');

//do_page_prequisites();
$css = '';
//$js=array('meny.js', 'group5js/check.js');
$js = array('tinymce/tinymce.min.js');
//require_once('/form/form_admin.php');
getHeader("Events", $css, $js);
output_page_menu();




if (!(isset($_GET["eventsid"]) && is_numeric($_GET["eventsid"]) && count($_GET) === 1 )) {
    echo'<h1>400 Bad request!</h1>'; // if the GET request is not a valid request
// simply check 
} else {
    
    
    $this_event_id = fix_str($_GET["eventsid"]);
    $event_id = fix_str($this_event_id); // for infection
    $event_handle = new Db_events();
    $user_handle = new Db_user();
    $aEvent = $event_handle->show_single_event($this_event_id);
    if ( empty($aEvent)) { // if the event id is not found in database
        echo'<h1>404 Page not found!</h1>';
    } else {


        if (isset($_SESSION['username'])) {
            $temp = fix_str($_SESSION['username']);
            $temp = $user_handle->get_uid_by_name($temp);
            $temp = (int) $temp;
        } else
            $temp = NULL;
        //print_r($aEvent);
        echo '<h1>', $aEvent["subject"], '</h1> ';
        echo '<div id="eventBox"> <table > <tr> <td>',
        $aEvent["body"]
        , '</td></tr></table></div>';

        echo '<div >',
        'createtime:', $aEvent["createtime"], ' lastedit:', $aEvent["lastedit"]
        , '</div>';


        // begin to showreply 
        //print_r( $event_handle->show_corresponding_reply($this_event_id));

        $this_reply_list = $event_handle->show_corresponding_reply($this_event_id);
        echo '</br></br>';
        foreach ($this_reply_list as $aReply) {
            echo ' <div> <table  width="600" style = " border: 1px solid black" > <tr><td> ', "Edited by ", $user_handle->get_name_by_uid($aReply['uid']),
            "   At:", $aReply['replytime'],
            ':</td></tr><tr><td >', $aReply['body'],
            '</td></tr> <tr><td></table></div></br>';
        }

        // here is to add new reply
        // need session to query user name here 
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



        echo'<form action="event_action.php" method="POST">';
        echo '</br> </br><table > <tr><td> ', "Reply:",
        '</td></tr><tr><td>',
        '<textarea name="content"></textarea>',
        '</td></tr></table>',
        '<input type="hidden" name="uid_who_reply" value="', $temp, '">',
        '<input type="hidden" name="this_event_id" value="', $this_event_id, '">'
        ;

        echo '<input type="submit" name="submit_reply" value="Submit" /></form>';
        echo '<br/><br/><br/><br/>';
        //echo "111111".$user_handle->get_uid_by_name($_SESSION['username']) ;
        //var_dump($_SESSION['username']);
        //var_dump($result);
    }
}
// replay form
getFooter();
?>