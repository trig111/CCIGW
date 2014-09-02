<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once 'include/common.php';

$css=array();
$js=array();
getHeader("Home",$css,$js);
output_page_menu();
  require_once 'dblib/db_events.php';
    require_once 'dblib/db_news.php';
    $news_handle = new Db_news();
    $event_handle = new Db_events();
    $myfile = fopen( "home_page_setting.txt", "r" ) or die( "Unable to open file!" );
    $slider= json_decode(trim( fgets( $myfile ) ),TRUE);
    $jumboStr=json_decode(trim( fgets( $myfile ) ));
    $num=json_decode(trim( fgets( $myfile ) ));
    $temp=array('index1'=>'nimei','index2'=>array('heh','hah'));
   // var_dump($temp);
//var_dump($slider[1]);
    //var_dump($jumboStr[1]);
//    var_dump($num);
    carousel($slider);
    jumbotron($jumboStr);
    latest_events_news($num);

getFooter();

function carousel($sliderStr){
    echo <<< zzeof
     <div id="ccigwdemo" class="carousel slide" data-interval="4000" data-ride="carousel" style="width: 1280px; hight:500px; margin: 0 auto">
    	<!-- Carousel indicators -->
        <ol class="carousel-indicators">
            <li data-target="#ccigwdemo" data-slide-to="0" class="active"></li>
zzeof;
    for($i=1;$i<$sliderStr[0];$i++){
         echo <<< zzeof
        <li data-target="#ccigwdemo" data-slide-to="$i"></li>
zzeof;
    }
    echo <<< zzeof
        </ol>   
       <!-- Carousel items -->
        <div class="carousel-inner">
zzeof;
    for($i=0;$i<$sliderStr[0];$i++){
        if($i==0) echo'<div class="active item">';
        else echo '<div class="item">';
        echo <<<zzeof
        <a href="{$sliderStr[1]['url'][$i]}">
                    <img src="{$sliderStr[1]['src'][$i]}" alt="" class="img-responsive"> 
                    <div class="carousel-caption">
                      <h3>{$sliderStr[1]['subject'][$i]}</h3>
                    </div>
                </a>
            </div>
zzeof;
    }
    echo <<< zzeof
        </div>
        <!-- Carousel nav -->
    <a class="carousel-control left" href="#ccigwdemo" data-slide="prev" >
      <span class="icon-prev"></span>
    </a>
    <a  class="carousel-control right" href="#ccigwdemo" data-slide="next">
      <span class="icon-next"></span>
    </a>
</div>
zzeof;
}

function jumbotron($jumboStr){
    echo <<<zzeof

<div class="jumbotron">
      <div class="container">
        <h1>$jumboStr[0]</h1>
        <p>$jumboStr[1]</p>
        <p>$jumboStr[2]</p>

        <p><a href="$jumboStr[3]" class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a></p>
      </div>
    </div>
zzeof;
}

function latest_events_news($num){
  global $news_handle,$event_handle;
    $num_news = $news_handle -> get_num_of_news();
    $num_events = $event_handle -> get_num_of_events();
    if(!isArrayOrString($num_news)||!isArrayOrString($num_events)){
    redirect($num_news.$num_events, 'admin_events.php?pg=1', 'admin events', 5,false);
    exit();
    }

if(empty($num_news)||empty($num_events)){
    redirect('no news or events reocrds!', 'admin_events.php?pg=1', 'admin events', 5,false);
    exit();
}
if($num_news[0]<$num||$num_events[0]<$num){
    redirect('less enough of news or events reocrds to display!', 'admin_events.php?pg=1', 'admin events', 5,false);
    exit();
}
    $news_list = $news_handle->admin_show_news_list(0, intval($num));
    $event_list = $event_handle->client_show_events_list(0,intval($num));
    if(!isArrayOrString($news_list)||!isArrayOrString($event_list)){
    redirect($num_news.$num_events, 'admin_events.php?pg=1', 'admin events', 5,false);
    exit();
    }
$title=array('<h2><font color="#71A9FF">Latest News: </font></h2>','<h2><font color="#71A9FF">Latest Events: </font></h2>');
    for ( $i = 0 ; $i < $num ; $i ++ ) { 

echo <<<zzeof
  
    <div class="container">
      <div class="row">
        <div class="col-md-6">
        $title[0]
          <h3> [{$news_list[$i]['categoryname']}] &nbsp;&nbsp;{$news_list[$i]['subject']}</h3>
          <p>by {$news_list[$i]['username']} &nbsp;&nbsp; | &nbsp;&nbsp; @{$news_list[$i]['createtime']}</p>
          <p><a class="btn btn-default" href="news.php?pg=1" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-6">
          $title[1]
          <h3>[{$event_list[$i]['categoryname']}] &nbsp;&nbsp;{$event_list[$i]['subject']}</h3>
          <p>{$event_list[$i]['username']} &nbsp;&nbsp; | &nbsp;&nbsp; @{$event_list[$i]['createtime']} </p>
          <p><a class="btn btn-default" href="eventpage.php?eventsid={$event_list[$i]['eventsid']}&pg=1" role="button">View details &raquo;</a></p>
       </div>
       
      <br />
      <hr />

zzeof;
          $title=array('','');
}
echo'</div></div>';
}
?>