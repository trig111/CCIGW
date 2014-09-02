<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    
require_once("include/common.php");

if(!clean('get',$keys=array())){
    redirect('illegal access!', 'index.php', 'home', 5,false);
    exit();
}

$error=array();
$pagesize = 5;

if(!validate()){
    redirect(implode("<br />", $error), $_SERVER['HTTP_REFERER'], 'home', 5,false);
    exit();
}


$css=array();
$js=array();
getHeader("News",$css,$js);
output_page_menu();
require_once('dblib/db_news.php');
$news_handle = new Db_news();
$num = $news_handle -> get_num_of_news();
$page_key = pagination($num[0],$pagesize,'news.php?');
$result=$news_handle->client_show_news_list( $page_key['offset'], $pagesize );
if(!isArrayOrString($result)){
    redirect($result, 'index.php', 'Home', 5,false);
    exit();
}

if(empty($result)){
    redirect('404 NOT FOUND', 'index.php', 'Home', 5,false);
    exit();
}

$newpost='';

if(is_admin()){
    $newpost='<div class="col-md-3 col-md-offset-6"><button type="button" class="btn btn-default btn-lg"><a href="tpl_post_news.php">Post New News</a></button></div>';
    
}
 echo<<<zzeof
<div style="width: 80%;margin:0 auto;">
<div class="page-header" ><h1>News</h1></div>
<div class="row">
<div class="col-md-3 col-md-offset-8">$newpost</div>
</div>
<br />
zzeof;
 $panel=array('panel panel-primary','panel panel-success','panel panel-info','panel panel-warning','panel panel-danger');
 $i=0;




foreach($result as $aNews){
    $aNewsArray=$news_handle->show_single_news( $aNews['newsid'] );
    if(!isArrayOrString($aNewsArray)){
        redirect($aNewsArray, 'index.php', 'Home', 5,false);
        exit();
    }

    if(empty($aNewsArray)){
        redirect('404 NOT FOUND', 'index.php', 'Home', 5,false);
        exit();
    }
    $is_editable='';
    if(is_admin()){
        $is_editable=' &nbsp;&nbsp; | &nbsp;&nbsp; <a href="'.'tpl_edit_news.php?newsid='.$aNewsArray['newsid'].'">edit</a>';
        $is_editable.=' &nbsp;&nbsp; | &nbsp;&nbsp; <a href="'.'server_news_action.php?newsid='.$aNewsArray['newsid'].'&action=delete">delete</a>';
    }
    // tpl_show_news
    echo <<< zzeof
    
 <div class="{$panel[$i++]}">
  <div class="panel-heading">
    <h3 class="panel-title">[{$aNewsArray['categoryname']}]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$aNewsArray['subject']}</h3>
  </div>
  <div class="panel-body">
   
    {$aNewsArray['body']}
  </div>
  <div class="panel-footer">
     by {$aNewsArray['username']} &nbsp;&nbsp; | &nbsp;&nbsp; created at : {$aNewsArray['createtime']} &nbsp;&nbsp; | &nbsp;&nbsp; lastedit at : {$aNewsArray['lastedit']}$is_editable
  </div>
  
</div>
<br /><br />    
zzeof;
}

echo $page_key['pagefooter'];
echo'</div>';

getFooter();

 function validate(){
     global $error;
     if(!is_numeric($_GET['pg'])||$_GET['pg']<1) $error['pg']='invalid page number!';
     if(empty($error))return true;
     else return false;
     
 }

?>