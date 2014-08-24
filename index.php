<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/demoframe.php';
require_once 'include/common.php';
require_once 'dblib/db_events.php';
require_once 'dblib/db_news.php';
$css=array('layout.css', 'slideshow.css');
//$js=array();
$js=array('jquery-1.3.1.min.js','slideshow.js','meny.js');
getHeader("Home",$css,$js,'',0);
output_page_menu();

//Show the body on the home page
echo '
		<ul class="slideshow">
				<li class="show">
					<a href="http://www.msn.com">
						<img src="images/ccigwdemo1.jpg" width="800" height="300" title="Enter the Dragon" alt="A yound girl 
						performs a Chinese dance."/>
					</a>
				</li>
				<li>
					<a href="http://www.msn.com">
						<img src="images/ccigwdemo2.jpg" width="800" height="300" title="DIY Dumplings" alt="Learn how to make you 
						own dumplings!"/>
					</a>
				</li>
				<li>
					<a href="http://www.msn.com">
						<img src="images/ccigwdemo4.jpg" width="800" height="300" title="God of Furtune" alt="Watch him perform"/>
					</a>
				</li>
				<li>
					<a href="http://www.msn.com">
						<img src="images/ccigwdemo5.jpg" width="800" height="300" title="Chinese Dance" alt="A youth 
						performs a Chinese dance."/>
					</a>
				</li>
				<li>
					<a href="http://www.msn.com">
						<img src="images/ccigwdemo6.jpg" width="800" height="300" title="Children Art" alt="Art Display"/>
					</a>
				</li>
			</ul>';
$news_handle = new Db_news();
$event_handle = new Db_events();
$news_list = $news_handle->show_all_news(0, 2);
$event_list = $event_handle->show_events_list(0, 2);
echo '<div id="news"><table><tr><td><h6>News</h6></td><td><h6>Upcoming Events</h6></td>';
for ( $i = 0 ; $i < 2 ; $i ++ ) 
{
    echo  '<tr><td>',
    
           '<a href="newspage.php?newsid=', $news_list[$i]["newsid"] ,
          '" > ', $news_list[$i]['subject'], '</a></td>',
           '<td><a href="eventpage.php?eventsid=', $event_list[$i]["eventsid"] ,
            '" > ', $event_list[$i]['subject'] , ' </a></td></tr>' ;

}

echo '</table></div>';
			




getFooter();

?>