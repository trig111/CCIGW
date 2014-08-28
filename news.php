<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once("include/demoframe.php");
require_once('dblib/db_news.php');

$css=array('bootstrap.css','ccigw.css');

$js=array('jquery-1.3.1.min.js','meny.js','group5js/check.js','bootstrap.js');

getHeader("News",$css,$js);
output_page_menu();

$news_handle = new Db_news();
$num = $news_handle -> get_num_of_news();

$pagesize = 3;
require_once('include/common.php');

$page_key = pagination($num,$pagesize);

 echo '<div class="page-header">
              <h1>News</h1>
              </div>';

 foreach( $news_handle->show_all_news($page_key[2], $pagesize) as $a_news )
    {

        echo '
           <div class="panel panel-default">
                        <div class="panel-heading"><a href="eventpage.php?eventsid=' ,$a_news['newsid'],'" > ', $a_news['subject'] , '</a></div>
                <div class="panel-body">
                         Panel content
                 </div>
          </div> ';
    }

    echo '<ul class="pagination">',
                  '<li><a href="news.php?pg=',$page_key[3],'">&laquo;</a></li>';
    for($i=0; $i<$page_key[1]; $i++){
        echo '<li><a href="news.php?pg=',$i+1,'">',$i+1,'</a></li>';
    }
    echo '<li><a href="news.php?pg=',$page_key[4],'">&raquo;</a></li>',
              '</ul>';
// echo <<<zzeof

// <div id="msg"><h2>Let AJAX change this text</h2></div>
//      <select id="area" onchange="changeFunc();">
//     <option>Choose languages</option>
//     <option  value="1" id="op1">ENGLISH</option>
//     <option  value="2" id="op2">CHINESE</option>
//   </select>

// zzeof;

getFooter();

?>