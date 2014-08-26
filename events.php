<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once('include/demoframe.php');

require_once('event_pagination.php');


$js=array('group5js/check.js');

getHeader("Events",'',$js,'',0);

output_page_menu();


getFooter();

?>