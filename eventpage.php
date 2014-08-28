
<?php

if (!isset($_SESSION)) {
    session_start();
}
require_once('dblib/db_events.php');
require_once('dblib/db_user.php');
require_once("include/demoframe.php");
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
}
$eventsid = fix_str($_GET["eventsid"]);
$event_handle = new Db_events();
$aEvent = $event_handle->show_single_event($eventsid);

if(empty($aEvent)) {
    //redirect
}
 if(is_legal_access($aEvent['uid'])){
     $is_editable='';
 }


echo<<< zzeof
<div style="width: 70%;margin:0 auto;">
 <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">{$aEvent['subject']}</h3>
  </div>
  <div class="panel-body">
    <fieldset>
         <legend>Time Period</legend>
    Start Time:{$aEvent['startime']} ><br />
    End Time: {$aEvent['endtime']} 
       
    </fieldset>
    <br />
    <fieldset>
        <legend> Attendance Allowance</legend>
    Maximum member:{$aEvent['maxmember']}<br />
    </fieldset>
    <br />
    <legend> Body</legend>
    {$aEvent['body']}
  </div>
  <div class="panel-footer">
     by {$aEvent['username']} &nbsp;&nbsp; | &nbsp;&nbsp; created at : {$aEvent['createtime']} &nbsp;&nbsp; | &nbsp;&nbsp; lastedit at : {$aEvent['lastedit']}
  </div>
</div>

zzeof;
     
 
    $pagesize = 8;
require_once('include/common.php');
$num  = $event_handle->get_num_of_evtreplys($eventsid);
var_dump($num);
$page_key = pagination($num,$pagesize,"eventpage.php?eventsid=$eventsid&");
var_dump($page_key);

if($num!=0){

        $this_reply_list = $event_handle->show_corresponding_reply($eventsid,$page_key['offset'],$pagesize);
        var_dump($this_reply_list);
        echo '<br /><br />';
        foreach ($this_reply_list as $aReply) {
            echo <<<zzeof
      <div class="panel panel-success">
        <div class="panel-body">
            {$aReply['body']}
        </div>
        <div class="panel-footer">
            by {$aReply['username']} &nbsp;&nbsp; | &nbsp;&nbsp; created at : {$aReply['replytime']} &nbsp;&nbsp; | &nbsp;&nbsp; lastedit at : {$aReply['lastedit']}
        </div>
      </div>      
     <br />       
zzeof;
        }
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
        "insertdatetime media table contextmenu paste",
        "insertdatetime media table contextmenu paste jbimages"

    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
    relative_urls: false
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
        echo '<br/><br/><br/><br/><div/>';
        //echo "111111".$user_handle->get_uid_by_name($_SESSION['username']) ;
        //var_dump($_SESSION['username']);
        //var_dump($result);
    
echo $page_key['pagefooter'];
// replay form
getFooter();
?>