<?php

require_once('dblib/db_events.php');

$event_handle = new Db_events();

// if(array_key_exists('page', $_GET)){
// 	$num  = $event_handle->get_num_of_events();    
// }
$num  = $event_handle->get_num_of_events();    


// echo $num;
//events_per_page
$pagesize=3;

$last = ceil($num/$pagesize);
// echo $last;
if($last<1){
  $last = 1;
}
//page number
$page =3;

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
              '<li><a href="#">&laquo;</a></li>';
for($i=0; $i<$last; $i++){
    echo '<li><a href="events.php?pg=',$i+1,'">',$i+1,'</a></li>';
}
echo '<li><a href="#">&raquo;</a></li>',
          '</ul>';


?>