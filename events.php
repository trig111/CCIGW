<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once('include/demoframe.php');

//require_once('event_pagination.php');
require_once('dblib/db_events.php');

$js=array('group5js/check.js');

getHeader("Events",'',$js,'',0);

output_page_menu();


$event_handle = new Db_events();
$num  = $event_handle->get_num_of_events();    
$pagesize = 3;
require_once('include/common.php');

$page_key = pagination($num,$pagesize);

 echo '<div class="page-header">
              <h1>Events</h1>
              </div>';

 foreach( $event_handle->show_events_list($page_key[2], $pagesize) as $aEvent)
    {

	    echo '
	       <div class="panel panel-default">
	                    <div class="panel-heading"><a href="eventpage.php?eventsid=' ,$aEvent["eventsid"],'" > ', $aEvent['subject'] , '</a></div>
	            <div class="panel-body">
	                     Panel content
	             </div>
	      </div> ';
    }

	echo '<ul class="pagination">',
	              '<li><a href="events.php?pg=',$page_key[0]-1,'">&laquo;</a></li>';
	for($i=0; $i<$page_key[1]; $i++){
	    echo '<li><a href="events.php?pg=',$i+1,'">',$i+1,'</a></li>';
	}
	echo '<li><a href="events.php?pg=',$page_key[0]+1,'">&raquo;</a></li>',
	          '</ul>';
getFooter();

?>