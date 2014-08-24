<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
require_once("include/demoframe.php");
require_once('dblib/db_news.php');

$css=array('bootstrap.css');

$js=array('jquery-1.3.1.min.js','meny.js','group5js/check.js','bootstrap.js');

getHeader("News",$css,$js,'',0);
output_page_menu();

$news_handle = new Db_news();
$news_list = $news_handle->show_all_news(0, 50);

echo '    <h4>40px</h4>

	<div id="news">
			<table><h1>News </h1>';
echo <<<zzeof

<div id="msg"><h2>Let AJAX change this text</h2></div>
     <select id="area" onchange="changeFunc();">
    <option>Choose languages</option>
    <option  value="1" id="op1">ENGLISH</option>
    <option  value="2" id="op2">CHINESE</option>
  </select>

zzeof;

foreach( $news_list as $a_news )
{
    //print_r($a_news);
    echo '<tr>';
        echo '<a href="newspage.php?newsid=', $a_news['newsid'], '" class="newsLink" id="firstNews">',
                $a_news['subject'],'</a></tr>';
        
}

	echo '</table></div>';

getFooter();

?>