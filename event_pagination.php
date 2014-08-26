<?php

require_once('dblib/db_events.php');

$event_handle = new Db_events();
$num  = $event_handle->get_num_of_events();    

if(array_key_exists('pg', $_GET)){
	$page =  $_GET['pg'] ;
}

if ($page<1) {
	$page =1 ;
}

// echo $num;
//events_per_page
$pagesize=5;

$last = ceil($num/$pagesize);

// echo $last;
if($last<1){
  $last = 1;
}
//page number

$current = ($page -1)* $pagesize;
    echo '<div class="page-header">
              <h1>Events</h1>
              </div>';
    foreach( $event_handle->show_events_list($current, $pagesize) as $aEvent)
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
              '<li><a href="events.php?pg=',$page-1,'">&laquo;</a></li>';
for($i=0; $i<$last; $i++){
    echo '<li><a href="events.php?pg=',$i+1,'">',$i+1,'</a></li>';
}
echo '<li><a href="events.php?pg=',$page+1,'">&raquo;</a></li>',
          '</ul>';


?>