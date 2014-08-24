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
    
        
    foreach( $event_handle->show_events_list(0, 50) as $aEvent)
    {

    echo '
    <div id="eventBox">
            <p id="eventInfo"> <a href="eventpage.php?eventsid=' ,$aEvent["eventsid"]
            ,'" > ', $aEvent['subject'] , '</a></p>
    </div>
';
    }

echo <<<zzeof
<div class="page-header">
        <h1>Events</h1>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Panel title</h3>
            </div>
            <div class="panel-body">
              Panel content
            </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Panel title</h3>
            </div>
            <div class="panel-body">
              Panel content
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">Panel title</h3>
            </div>
            <div class="panel-body">
              Panel content
            </div>
          </div>
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Panel title</h3>
            </div>
            <div class="panel-body">
              Panel content
            </div>
          </div>
        </div><!-- /.col-sm-4 -->
        <div class="col-sm-4">
          <div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title">Panel title</h3>
            </div>
            <div class="panel-body">
              Panel content
            </div>
          </div>
          <div class="panel panel-danger">
            <div class="panel-heading">
              <h3 class="panel-title">Panel title</h3>
            </div>
            <div class="panel-body">
              Panel content
            </div>
          </div>
        </div><!-- /.col-sm-4 -->
      </div>

zzeof;

getFooter();

?>