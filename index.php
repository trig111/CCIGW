<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/demoframe.php';
require_once 'include/common.php';
require_once 'dblib/db_events.php';
require_once 'dblib/db_news.php';
$css='';
//$js=array();
$js=array();


getHeader("Home",$css,$js,'',0);


output_page_menu();

//<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
echo <<<zzeof

	<div class="container"></div>

	 <div id="ccigwdemo" class="carousel slide">
        <ol class="carousel-indicators">
          <li data-target="#ccigwdemo" data-slide-to="0" class="active"></li>
          <li data-target="#ccigwdemo" data-slide-to="1"></li>
          <li data-target="#ccigwdemo" data-slide-to="2"></li>
          <li data-target="#ccigwdemo" data-slide-to="3"></li>
        </ol>

        <div class="carousel-inner">
      <div class="item active"><img src="images/ccigwdemo1.jpg" alt="" class="img-responsive">
        <div class="carousel-caption">
          <h3>A yound girl performs a Chinese dance.</h3>
        </div>
      </div>
      <div class="item"><img src="images/ccigwdemo2.jpg" alt="" class="img-responsive">   
      <div class="carousel-caption">
        <h3>Learn how to make you own dumplings!</h3>
      </div>
      </div>
      <div class="item"><img src="images/ccigwdemo4.jpg" alt="" class="img-responsive">   
      <div class="carousel-caption">
        <h3>Watch him perform</h3>
      </div></div>
      
      <div class="item"><img src="images/ccigwdemo6.jpg" alt="" class="img-responsive">   
      <div class="carousel-caption">
        <h3>Art Display</h3>
      </div></div>
      </div>

    <a class="carousel-control left" href="#ccigwdemo" data-slide="prev" >
      <span class="icon-prev"></span>
    </a>
    <a  class="carousel-control right" href="#ccigwdemo" data-slide="next">
      <span class="icon-next"></span>
    </a>
  
    </div>

zzeof;

//Show the body on the home page
/*echo '
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
*/


//upcoming evetns
$news_handle = new Db_news();
$event_handle = new Db_events();
$news_list = $news_handle->show_all_news(0, 2);
$event_list = $event_handle->show_events_list(0, 2);
/*echo '<div id="news"><table><tr><td><h6>News</h6></td><td><h6>Upcoming Events</h6></td>';
for ( $i = 0 ; $i < 2 ; $i ++ ) 
{
    echo  '<tr><td>',
    
           '<a href="newspage.php?newsid=', $news_list[$i]["newsid"] ,
          '" > ', $news_list[$i]['subject'], '</a></td>',
           '<td><a href="eventpage.php?eventsid=', $event_list[$i]["eventsid"] ,
            '" > ', $event_list[$i]['subject'] , ' </a></td></tr>' ;

}

echo '</table></div>';
	*/		
echo <<<zzeof

<div class="jumbotron">
      <div class="container">
        <h1>Introduction!</h1>
        <p>we can have some intro here. blablabla</p>
        <p>its better if you have more than 2 rows or using more than 3 br</p>

        <p><a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>
      </div>
    </div>
zzeof;

for ( $i = 0 ; $i < 2 ; $i ++ ) { 

echo <<<zzeof
  
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2>News</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
zzeof;

        echo  '<p><a class="btn btn-default" href="newspage.php?newsid=',$news_list[$i]['newsid'],'" role="button">View details &raquo;</a></p>';

echo <<<zzeof
        </div>
        <div class="col-md-6">
          <h2>Upcoming Events</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
       </div>
       
      <br>
      <hr>

zzeof;
 } 

getFooter();

?>