<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once('include/demoframe.php');

//require_once('event_pagination.php');
require_once('dblib/db_events.php');

$js=array('group5js/check.js');

getHeader("Events",'',$js);

output_page_menu();

$lastreply_str='';
$event_handle = new Db_events();
$num  = $event_handle->get_num_of_events();    
$pagesize = 30;
require_once('include/common.php');

$page_key = pagination($num,$pagesize,'events.php?');
$newpost='';
if(is_admin()) $newpost='<div class="col-md-3 col-md-offset-10"><button type="button" class="btn btn-default btn-lg"><a href="tpl_post_event.php">Post New Event</a></button></div>';
 echo <<<zzeof
    <div class="page-header"><h1>Events</h1></div>
   $newpost
                  <table class="table table-striped">
            <thead>
                <tr>
                  <th>Category</th>
                  <th>Subject</th>
                  <th>Author</th>
                  <th>Reply</th>
                  <th>LastReply</th>
                </tr>
              </thead>
              <tbody>
zzeof;

//better to check more
 foreach( $event_handle->client_show_events_list($page_key['offset'], $pagesize) as $aEvent)
    {
        $total_replies=$event_handle->get_num_of_evtreplys($aEvent['eventsid']);
        if(!is_last_reply($total_replies[0],$aEvent['eventsid'])) $lastreply_str="{$aEvent['username']} <br /> {$aEvent['createtime']}";
        
            echo <<< zzeof
             <tr>
               <th>[{$aEvent['categoryname']}]</th>"
               <th><a href="eventpage.php?eventsid={$aEvent['eventsid']}&pg=1" >{$aEvent['subject']}</a></th>
	      <th>{$aEvent['username']} <br /> {$aEvent['createtime']}</th>
              <th>$total_replies[0]</th>
              <th>$lastreply_str</th>
              </tr>
            
zzeof;
        //}
//	    echo '
//	       <div class="panel panel-default">
//	       <div class="panel-heading"><a href="eventpage.php?eventsid=' ,$aEvent["eventsid"],'" > ', $aEvent['subject'] , '</a></div>
//	      </div> ';
    }

//	echo '<ul class="pagination">',
//	              '<li><a href="events.php?pg=',$page_key[3],'">&laquo;</a></li>';
//        $pre='<strong style="color:black">';
//	for($i=1; $i<=$page_key[1]; $i++){
//            if($i==$page_key[0])echo '<li><a href="events.php?pg=',$i,'">',$pre.$i,'</strong></a></li>';
//            
//	    else echo '<li><a href="events.php?pg=',$i,'">',$i,'</a></li>';
//	}
//	echo '<li><a href="events.php?pg=',$page_key[4],'">&raquo;</a></li>',
//	          '</ul>';
    echo'</tbody></table>';
    echo $page_key['pagefooter'];
getFooter();

function is_last_reply($total_replies,$eventsid){
    global $event_handle ,$lastreply_str;
    if($total_replies!=0){
            $lastreply=$event_handle->show_corresponding_last_reply($eventsid);
            //var_dump($lastreply);
            $lastreply_str="{$lastreply['username']} <br /> {$lastreply['lastreply']}";
            return true;
        }
        
    return false;
}

?>