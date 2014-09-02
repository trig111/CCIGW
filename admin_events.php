<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once("include/common.php");
if(!is_admin()||!clean('get',$keys=array())){
    redirect('illegal access!', 'index.php', 'home', 5,false);
    exit();
}
$error=array();
if(!validate()){
    redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'home', 5,false);
    exit();
}


require_once('dblib/db_events.php');
$de = new Db_events();
$num=$de->get_num_of_events();
if(!isArrayOrString($num)){
     redirect($num, $_SERVER['HTTP_REFERER'], 'Events Admin', 5,false);
            exit();  
}
if(empty($num)){
     redirect('404 NOT FOUND', $_SERVER['HTTP_REFERER'], 'Events Admin', 5,false);
            exit();  
}
$pagesize = 100;
$page_key = pagination($num[0],$pagesize,'admin_events.php?');

$result=$de->admin_show_events_list($page_key['offset'],$pagesize);
if(!isArrayOrString($result)){
     redirect($result, $_SERVER['HTTP_REFERER'], 'Events Admin', 5,false);
            exit();  
}
if(empty($result)){
     redirect('404 NOT FOUND', $_SERVER['HTTP_REFERER'], 'Events Admin', 5,false);
            exit();  
}


$css = array('jquery.dataTables.min.css','simple-sidebar.css');

$js = array('jquery.dataTables.min.js');

//var_dump($result);
getHeader("Superuser", $css, $js);
output_page_menu();
getSidebarHeader();
echo <<<ZZEOF

<table id="datatables" class="display" border="2">
<h2>Events Info Table</h2>
					<thead>
						<tr>
                                                        
                                                        <th>Eid</th>
                                                        <th>Category</th>
							 <th>Titile</th>
							 <th>Author</th>
							 <th>Access</th>
							 <th>MaxMember</th>
                                                         <th>Startime</th>
							 <th>Endtime</th>
                                                         <th>Action</th>
							
						</tr>
					 </thead>
                                        <tbody>
ZZEOF;
foreach( $result as $row){
echo <<<ZZEOF
    
    
    <td>{$row['eventsid']}</td>
    <td>{$row['categoryname']}</td>
    <td>{$row['subject']}</td>
    <td>{$row['username']}</td>
    <td>{$row['readaccess']}</td>
    <td>{$row['maxmember']}</td>
    <td>{$row['startime']}</td>
    <td>{$row['endtime']}</td>
    <td><a href="eventpage.php?eventsid={$row['eventsid']}&pg=1">edit</a> | <a href="server_event_action.php?eventsid={$row['eventsid']}&action=delete">del</a></td>
</tr>

ZZEOF;
}
echo <<<ZZEOF

						
					</tbody>
			 </table>
<script language="JavaScript">	
$(document).ready( function () {
    $('#datatables').DataTable({
      "autoWidth": false,
      "paging": false,
      "autoWidth": false
      
   });
    
} );


</script>
<br /><br />

ZZEOF;
echo $page_key['pagefooter'];
getSidebarFooter();
getFooter();
 function validate(){
     global $error;
     if(!is_numeric($_GET['pg'])||$_GET['pg']<1) $error['pg']='invalid page number!';
     if(empty($error))return true;
     else return false;
     
 }
?>