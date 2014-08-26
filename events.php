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
    
        
    echo '<div class="page-header">
              <h1>Events</h1>
              </div>';
    foreach( $event_handle->show_events_list(0, 50) as $aEvent)
    {

    echo '
       <div class="panel panel-default">
                    <div class="panel-heading"><a href="eventpage.php?eventsid=' ,$aEvent["eventsid"],'" > ', $aEvent['subject'] , '</a></div>
            <div class="panel-body">
                     Panel content
             </div>
      </div> ';

}



getFooter();

?>