<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once('include/demoframe.php');
require_once('dblib/db_events.php');

$css=array('layout.css');

$js=array('jquery-1.3.1.min.js','meny.js','group5js/check.js');

getHeader("Events",$css,$js,'',0);

output_page_menu();

//require_once('/form/form_admin.php');


//display_admin_form();

$event_handle = new Db_events();
    echo'
    <h1>Events</h1>';
        
    foreach( $event_handle->show_events_list(0, 50) as $aEvent)
    {

    echo '
    <div id="eventBox">
            <p id="eventInfo"> <a href="eventpage.php?eventsid=' ,$aEvent["eventsid"]
            ,'" > ', $aEvent['subject'] , '</a></p>
    </div>
';
    }

getFooter();

?>