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

$page_key = pagination($num,$pagesize,'news.php?');

 echo '<div class="page-header">
              <h1>News</h1>
              </div>';

 foreach( $news_handle->show_all_news($page_key['offset'], $pagesize) as $a_news )
    {
      echo <<<zzeof
            <div class="panel panel-default">
                         <div class="panel-heading"><a href="newspage.php?newsid={$a_news['newsid']}" > {$a_news['subject']}</a></div>
zzeof;
  $result = $news_handle->show_single_news($a_news['newsid']);
echo <<<zzeof
                 <div class="panel-body">
                        {$result['body']}
                  </div>
           </div> 
zzeof;

    }



echo $page_key['pagefooter'];
getFooter();

?>