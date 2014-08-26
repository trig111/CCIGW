<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once("include/demoframe.php");
require_once('dblib/db_events.php');
$css = array('jquery.dataTables.min.css');

$js = array('jquery.dataTables.min.js');


$de = new Db_events();
$result=$de->admin_show_events_list(0,100);
//var_dump($result);
getHeader("Superuser", $css, $js, '', 0);
output_page_menu();
echo <<<ZZEOF
<table id="datatables" class="display" border="2">
					<thead>
						<tr>
                                                        <th>checkbox</th>
                                                        <th>eventsid</th>
                                                        <th>category</th>
							 <th>Titile</th>
							 <th>Author</th>
							 <th>readaccess</th>
							 <th>maxmember</th>
                                                         <th>createtime</th>
							 <th>lastedit</th>
                                                         <th>action</th>
							
						</tr>
					 </thead>
                                        <tbody>
ZZEOF;
foreach( $result as $row){
echo <<<ZZEOF
    
    <td><input type="checkbox" name="checkbox[]" id="{$row['eventsid']}"value=""></td>
    <td>{$row['eventsid']}</td>
    <td>{$row['categoryname']}</td>
    <td>{$row['subject']}</td>
    <td>{$row['username']}</td>
    <td>{$row['readaccess']}</td>
    <td>{$row['maxmember']}</td>
    <td>{$row['createtime']}</td>
    <td>{$row['lastedit']}</td>
    <td><a href="event_manage.php?eventsid={$row['eventsid']}&action=edit">edit</a> | <a href="event_manage.php?eventsid={$row['eventsid']}&action=del">delete</a></td>
</tr>

ZZEOF;
}
echo <<<ZZEOF

						
					</tbody>
			 </table>
<script language="JavaScript">	
$(document).ready( function () {
    $('#datatables').DataTable({
      "paging": false  
   });
    
} );
</script>
ZZEOF;
getFooter();
?>