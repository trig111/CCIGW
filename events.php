<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once('include/demoframe.php');
require_once('dblib/db_events.php');



$js=array('group5js/check.js');

getHeader("Events",'',$js,'',0);

output_page_menu();

//require_once('/form/form_admin.php');


//display_admin_form();


$event_handle = new Db_events();



$num  = $event_handle->get_num_of_events();    
// echo $num;
$last = ceil($num/10);
// echo $last;
if($last<1){
  $last = 1;
}
//page number
$page =2;

//events_per_page
$pagesize=3;


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
    echo '<li><a href="#">',$i+1,'</a></li>';
}
echo '<li><a href="#">&raquo;</a></li>',
          '</ul>';

getFooter();

?>